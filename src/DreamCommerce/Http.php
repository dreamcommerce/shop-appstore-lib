<?php
namespace DreamCommerce;

use DreamCommerce\Exception\HttpException;

/**
 * HTTP I/O abstraction
 * @package DreamCommerce
 */
class Http
{

    /**
     * retry count before giving up on leaking bucket quota exceeding
     * @var int
     */
    protected static $retryLimit = 5;

    /**
     * Singleton
     * @return Http
     */
    public static function instance(){
        static $instance = null;

        if($instance===null){
            $instance = new Http();
        }

        return $instance;
    }

    /***
     * set connection retrying limit
     * @param int $num
     * @throws HttpException
     */
    public static function setRetryLimit($num){
        if($num<1){
            throw new HttpException('Limit '.(int)$num.' is too low', HttpException::LIMIT_TOO_LOW);
        }

        self::$retryLimit = $num;
    }

    /**
     * performs a GET request
     * @param string $url
     * @param array $query query string params
     * @param array $headers
     * @return string
     */
    public function get($url, $query = array(), $headers = array())
    {
        return $this->perform('get', $url, array(), $query, $headers);
    }

    /**
     * performs a POST request
     * @param string $url
     * @param array|\stdClass $body form fields
     * @param array $query query string params
     * @param array $headers
     * @return string
     */
    public function post($url, $body = array(), $query = array(), $headers = array())
    {
        return $this->perform('post', $url, $body, $query, $headers);
    }

    /**
     * performs a PUT request
     * @param string $url
     * @param array|\stdClass $body form fields
     * @param array $query query string params
     * @param array $headers
     * @return string
     */
    public function put($url, $body = array(), $query = array(), $headers = array())
    {
        return $this->perform('put', $url, $body, $query, $headers);
    }

    /**
     * performs a DELETE request
     * @param $url
     * @param array $query query string params
     * @param array $headers
     * @return string
     */
    public function delete($url, $query = array(), $headers = array())
    {
        return $this->perform('delete', $url, array(), $query, $headers);
    }

    /**
     * make a real request
     * @param string $method HTTP method
     * @param string $url
     * @param array $body
     * @param array $query
     * @param array $headers
     * @return array an array with two fields - "headers" and "data"
     * @throws Exception\HttpException
     */
    protected function perform($method, $url, $body = array(), $query = array(), $headers = array())
    {

        static $lastRequestHeaders = array();

        // determine allowed methods
        $methodName = strtoupper($method);

        $this->debug('NEW REQUEST: '.$methodName.' '.$url);

        if (!in_array($methodName, array(
            'GET', 'POST', 'PUT', 'DELETE'
        ))
        ) {
            throw new HttpException('Method not supported', HttpException::METHOD_NOT_SUPPORTED);
        }

        // prepare request headers and fields
        $contextParams = array(
            'http' => array(
                'method' => $methodName,
                'ignore_errors'=>true   // we want to catch output although the error
            ));

        // stringifying headers
        if ($headers) {
            $headersString = '';
            foreach ($headers as $k => $v) {
                $headersString .= $k . ': ' . $v . "\r\n";
            }
            $contextParams['http']['header'] = $headersString;

            $this->debug('Headers: '.var_export($headers, true));
        }

        // request body
        if ($methodName == 'POST' || $methodName == 'PUT') {

            $body = (array)$body;

            if(!empty($headers['Content-Type']) && $headers['Content-Type']=='application/json'){
                $content = json_encode($body);
            }else{
                $content = http_build_query($body);
            }

            $contextParams['http']['content'] = $content;

            $this->debug('Document body: '.var_export($body, true));
            $this->debug('Document body (JSON-ified): '.$content);
        }

        // make request stream context
        $ctx = stream_context_create($contextParams);

        // query string processing
        $processedUrl = $url;

        if ($query) {
            // URL has already query string, merge
            if (strpos($url, '?') !== false) {
                $components = parse_url($url);
                $params = array();
                parse_str($components['query'], $params);
                $params = $params + $query;
                $components['query'] = http_build_query($params);
                $processedUrl = http_build_url($components);
            } else {
                $processedUrl .= '?' . http_build_query($query);
            }
        }

        // perform request
        $doRequest = function($url, $ctx) use(&$lastRequestHeaders) {
            // make a real request
            $result = @file_get_contents($url, null, $ctx);

            // catch headers
            $lastRequestHeaders = $this->parseHeaders($http_response_header);

            $this->debug('Response headers: '.var_export($lastRequestHeaders, true));
            $this->debug('Response body: '.$result);

            try {
                // completely failed
                if (!$result) {
                    throw new \Exception();
                } else if ($lastRequestHeaders['Code'] < 200 || $lastRequestHeaders['Code'] >= 400) {
                    // server returned error code

                    // decode if it's JSON
                    if($lastRequestHeaders['Content-Type']=='application/json'){
                        $result = @json_decode($result);
                    }

                    if (is_object($result)){
                        throw new HttpException($result->error_description, HttpException::REQUEST_FAILED, null, $lastRequestHeaders, $result);
                    }else{
                        throw new \Exception($result);
                    }
                }
            }catch(\Exception $ex){
                throw new HttpException(
                    'HTTP request failed',
                    HttpException::REQUEST_FAILED,
                    $ex,
                    $lastRequestHeaders
                );
            }

            return $result;
        };

        // initialize requests counter
        $counter = self::$retryLimit;

        $result = null;

        // perform request regarding counter limit and quotas
        while(true){
            try {
                // pause upon limits exceeding
                if(isset($lastRequestHeaders['X-Shop-Api-Calls'])){

                    $calls = $lastRequestHeaders['X-Shop-Api-Calls'];
                    $bandwidth = $lastRequestHeaders['X-Shop-Api-Bandwidth'];
                    $limit = $lastRequestHeaders['X-Shop-Api-Limit'];

                    if($limit-$calls<=1){
                        sleep(ceil(2/$bandwidth));
                    }

                }

                $result = $doRequest($processedUrl, $ctx);

                break;
            }catch(HttpException $ex){
                // server pauses request for X seconds
                if(!empty($lastRequestHeaders['Retry-After'])){
                    if($counter<=0){
                        throw new HttpException('Retries count exceeded', HttpException::QUOTA_EXCEEDED, null, $lastRequestHeaders);
                    }
                    sleep($lastRequestHeaders['Retry-After']);
                }else{
                    // other error
                    throw $ex;
                }
            }

            $counter--;
        }

        // try to decode response
        if($lastRequestHeaders['Content-Type']=='application/json') {
            $parsedPayload = @json_decode($result);

            if (!$parsedPayload && !is_array($parsedPayload)) {
                throw new HttpException('Result is not a valid JSON', HttpException::MALFORMED_RESULT, null, $lastRequestHeaders, $result);
            }

        }else{
            $parsedPayload = $result;
        }

        $this->debug('Response body (decoded): '.var_export($parsedPayload, true));

        return array(
            'data' => $parsedPayload,
            'headers' => $lastRequestHeaders
        );
    }

    /**
     * transform headers from $http_response_header
     * @param array $src
     * @internal param $headers
     * @internal param $http_response_header
     * @return array
     */
    protected function parseHeaders($src)
    {
        $headers = array();
        foreach ($src as $i) {
            $row = explode(':', $i, 2);

            // header with no key/value - HTTP response, get code and status
            if(!isset($row[1])){
                $headers[] = $row[0];

                $matches = array();
                if(preg_match('#HTTP/1.[0-1] ([0-9]{3}) (.+)#si', $row[0], $matches)){
                    $headers['Code'] = $matches[1];
                    $headers['Status'] = $matches[2];
                }

                continue;
            }

            $key = trim($row[0]);
            $val = trim($row[1]);
            $headers[$key] = $val;
        }
        return $headers;
    }

    /**
     * internal debugging method
     * @param string $str message
     */
    protected function debug($str){
        Exception::debug($str);
    }

} 