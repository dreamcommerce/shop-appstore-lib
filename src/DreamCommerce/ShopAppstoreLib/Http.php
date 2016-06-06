<?php

namespace DreamCommerce\ShopAppstoreLib;

use DreamCommerce\ShopAppstoreLib\Exception\HttpException;
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
     * @var boolean
     */
    protected $skipSsl = false;

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
     * skip SSL errors
     * @param boolean $status
     */
    public function setSkipSsl($status)
    {
        $this->skipSsl = $status;
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
    public function head($url, $query = array(), $headers = array())
    {
        return $this->perform('head', $url, array(), $query, $headers);
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

        // response data placeholders
        $response = null;
        $responseHeaders = array();

        $logger = $this->getLogger();

        // determine allowed methods
        $methodName = strtoupper($method);

        // query string processing
        $processedUrl = $this->prepareUrl($url, $query);

        try {

            $logger->debug('NEW REQUEST: ' . $methodName . ' ' . $processedUrl);

            if (!in_array($methodName, array(
                'GET', 'POST', 'PUT', 'DELETE', 'HEAD'
            ))
            ) {
                throw new \Exception('Method not supported', HttpException::METHOD_NOT_SUPPORTED);
            }

            // prepare request headers and fields
            $contextParams = array(
                'http' => array(
                    'method' => $methodName,
                    'ignore_errors' => true   // we want to catch output although the error
                ));

            // skip SSL verification
            if($this->skipSsl){
                $contextParams['ssl'] = array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false
                );
            }

            // inject request parameters
            $this->applyHeaders($contextParams, $headers);
            $json = !empty($headers['Content-Type']) && $headers['Content-Type']=='application/json';
            $this->applyBody($contextParams, $methodName, $body, $json);

            // make request stream context
            $ctx = stream_context_create($contextParams);

            // initialize requests counter
            $counter = self::$retryLimit;

            $response = null;

            // perform request regarding counter limit and quotas
            while ($counter--) {
                try {
                    // pause upon limits exceeding
                    if (isset($responseHeaders['X-Shop-Api-Calls'])) {

                        $calls = $responseHeaders['X-Shop-Api-Calls'];
                        $limit = $responseHeaders['X-Shop-Api-Limit'];

                        if ($limit - $calls == 0) {
                            sleep(1);
                        }
                    }

                    $response = $this->doRequest($processedUrl, $ctx, $responseHeaders, $methodName);

                    break;
                } catch (\Exception $ex) {
                    // server pauses request for X seconds
                    if (!empty($responseHeaders['Retry-After'])) {
                        if ($counter <= 0) {
                            throw new \Exception('Retries count exceeded', HttpException::QUOTA_EXCEEDED);
                        }
                        sleep($responseHeaders['Retry-After']);
                    } else {
                        // other error
                        throw $ex;
                    }
                }
            }

            $parsedPayload = null;
            if ($methodName != 'HEAD') {
                // try to decode response
                if ($responseHeaders['Content-Type'] == 'application/json') {
                    $parsedPayload = @json_decode($response, true);

                    if (!$parsedPayload && !is_array($parsedPayload)) {
                        throw new \Exception('Result is not a valid JSON', HttpException::MALFORMED_RESULT);
                    }

                } else {
                    $parsedPayload = $response;
                }

                $logger->debug('Response body (decoded): ' . var_export($parsedPayload, true));
            }
        }catch(\Exception $ex){

            $message = $ex->getMessage();

            $logger->error(
                $ex->getMessage(), compact('method', 'url', 'query', 'headers', 'body', 'responseHeaders', 'response')
            );

            if($ex instanceof HttpException){
                $response = $ex->getResponse();
                $message = $ex->getMessage();
            }

            throw new HttpException(
                $message, $ex->getCode(), null, $method, $url, $headers, $query, $body, $response, $responseHeaders
            );
        }

        return array(
            'data' => $parsedPayload,
            'headers' => $responseHeaders
        );
    }

    protected function applyHeaders(&$contextParams, $headers)
    {
        if(!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        if(!isset($headers['Accept-Encoding'])) {
            $headers['Accept-Encoding'] = 'gzip';
        }

        $headersString = '';
        foreach ($headers as $k => $v) {
            $headersString .= $k . ': ' . $v . "\r\n";
        }
        $contextParams['http']['header'] = $headersString;


        $this->getLogger()->debug('Headers: '.var_export($headers, true));
    }

    /**
     * transform headers from $http_response_header
     * @param array $src
     * @internal param $headers
     * @internal param $http_response_header
     * @return array
     */
    public function parseHeaders($src)
    {
        $headers = array();

        $codeMatched = false;
        foreach ($src as $i) {
            $row = explode(':', $i, 2);

            // header with no key/value - HTTP response, get code and status
            if(!isset($row[1])){
                $headers[] = $row[0];

                $matches = array();
                if(!$codeMatched && preg_match('#HTTP/1.[0-1] ([0-9]{3})(.*)#si', $row[0], $matches)){
                    $headers['Code'] = $matches[1];
                    $headers['Status'] = trim($matches[2]);
                    $codeMatched = true;
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

    /**
     * add body contents to the POST/PUT request
     * @param array $contextParams target context resource
     * @param string $methodName HTTP method
     * @param array $body request body
     * @param bool $json body encoding method
     */
    protected function applyBody(&$contextParams, $methodName, $body, $json = true)
    {
        // request body
        if ($methodName == 'POST' || $methodName == 'PUT') {

            $body = (array)$body;

            if($json){
                $content = @json_encode($body);
                if(!$content){
                    throw new \Exception('Body is not serializable');
                }
            }else{
                $content = http_build_query($body);
            }

            $contextParams['http']['content'] = $content;

            $logger = $this->getLogger();
            $logger->debug('Document body: '.var_export($body, true));
            $logger->debug('Document body (JSON-ified): '.$content);
        }
    }

    /**
     * return an URL with query string
     * @param string $url base URL
     * @param array $query query string contents
     * @return string
     */
    protected function prepareUrl($url, $query = array())
    {
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

        return $processedUrl;
    }

    /**
     * perform target request
     * @param string $url URL
     * @param Resource $ctx context
     * @param array $responseHeaders reference to returned headers
     * @param string $methodName HTTP method
     * @return mixed|string
     * @throws \Exception
     */
    protected function doRequest($url, $ctx, &$responseHeaders, $methodName) {
        // make a real request
        $result = @file_get_contents($url, null, $ctx);
        if (!$result) {
            throw new \Exception('HTTP request failed', HttpException::REQUEST_FAILED);
        }

        // catch headers
        $responseHeaders = $this->parseHeaders($http_response_header);

        foreach (array('Content-Encoding', 'content-encoding') as $header) {
            if (isset($responseHeaders[$header])) {
                if (strtolower($responseHeaders[$header]) == 'gzip') {
                    $result = gzinflate(substr($result, 10, -8));
                    break;
                }
            }
        }

        $logger = $this->getLogger();
        $logger->debug('Response headers: ' . var_export($responseHeaders, true));
        $logger->debug('Response body: ' . $result);

        // completely failed
        if (!$result && $methodName != 'HEAD') {
            throw new \Exception('No response from server');
        } else if ($responseHeaders['Code'] < 200 || $responseHeaders['Code'] >= 400) {
            // server returned error code

            // decode if it's JSON
            if ($responseHeaders['Content-Type'] == 'application/json') {
                $parsedResult = @json_decode($result, true);
            }

            // pass responses (not) decoded to the adequate exception parameters
            if (isset($parsedResult) && is_array($parsedResult)) {
                $description = $parsedResult['error'];
                if (isset($parsedResult['error_description'])) {
                    $description = $parsedResult['error_description'];
                }
            } else {
                $description = 'Server error occurred';
            }

            throw new HttpException(
                $description,
                $responseHeaders['Code'],
                null,
                $methodName,
                null,
                array(),
                array(),
                array(),
                $result,
                $responseHeaders
            );
        }

        return $result;
    }

}