<?php
namespace DreamCommerce;

use DreamCommerce\Exception\HttpException;
use Psr\Log\LoggerInterface;

/**
 * HTTP I/O abstraction
 * @package DreamCommerce
 */
class Http implements HttpInterface
{
    /**
     * retry count before giving up on leaking bucket quota exceeding
     * @var int
     */
    protected static $retryLimit = 5;

    /**
     * @var LoggerInterface
     */
    protected $logger;

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
     * {@inheritdoc}
     */
    public function get($url, $query = array(), $headers = array())
    {
        return $this->perform('get', $url, array(), $query, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post($url, $body = array(), $query = array(), $headers = array())
    {
        return $this->perform('post', $url, $body, $query, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put($url, $body = array(), $query = array(), $headers = array())
    {
        return $this->perform('put', $url, $body, $query, $headers);
    }

    /**
     * {@inheritdoc}
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

        $logger = $this->getLogger();
        $logger->debug('NEW REQUEST: '.$methodName.' '.$url.'?'.http_build_query($query));

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

            $logger->debug('Headers: '.var_export($headers, true));
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

            $logger->debug('Document body: '.var_export($body, true));
            $logger->debug('Document body (JSON-ified): '.$content);
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

        $that = $this;

        // perform request
        $doRequest = function($url, $ctx) use(&$lastRequestHeaders, $that) {
            // make a real request
            $result = @file_get_contents($url, null, $ctx);

            // catch headers
            $lastRequestHeaders = $that->parseHeaders($http_response_header);

            $logger = $that->getLogger();
            $logger->debug('Response headers: '.var_export($lastRequestHeaders, true));
            $logger->debug('Response body: '.$result);

            try {
                // completely failed
                if (!$result) {
                    throw new \Exception();
                } else if ($lastRequestHeaders['Code'] < 200 || $lastRequestHeaders['Code'] >= 400) {
                    // server returned error code

                    // decode if it's JSON
                    if($lastRequestHeaders['Content-Type']=='application/json'){
                        $result = @json_decode($result, true);
                    }

                    if (is_array($result)){
                        throw new HttpException($result['error_description'], HttpException::REQUEST_FAILED, null, $lastRequestHeaders, $result);
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
                    //$bandwidth = $lastRequestHeaders['X-Shop-Api-Bandwidth'];
                    $limit = $lastRequestHeaders['X-Shop-Api-Limit'];

                    if($limit-$calls == 0){
                        //sleep(ceil(2/$bandwidth));
                        sleep(1);
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
            $parsedPayload = @json_decode($result, true);

            if (!$parsedPayload && !is_array($parsedPayload)) {
                throw new HttpException('Result is not a valid JSON', HttpException::MALFORMED_RESULT, null, $lastRequestHeaders, $result);
            }

        }else{
            $parsedPayload = $result;
        }

        $logger->debug('Response body (decoded): '.var_export($parsedPayload, true));

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
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogger()
    {
        if($this->logger === null) {
            $this->logger = new Logger();
        }

        return $this->logger;
    }
}