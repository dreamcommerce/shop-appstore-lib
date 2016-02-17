<?php

namespace DreamCommerce\ShopAppstoreLib\Exception;

use DreamCommerce\ShopAppstoreLib\Exception;

/**
 * Class HttpException
 * @package DreamCommerce\ShopAppstoreLib\Exception
 */
class HttpException extends Exception
{
    /**
     * specified HTTP request method is not supported
     */
    const METHOD_NOT_SUPPORTED = 1;

    /**
     * request failed due to the unknown error
     */
    const REQUEST_FAILED = 2;

    /**
     * data format is malformed, check JSON validity
     */
    const MALFORMED_RESULT = 3;

    /**
     * too many requests
     */
    const QUOTA_EXCEEDED = 4;

    /**
     * you specified too low limit for retries count
     */
    const LIMIT_TOO_LOW = 5;

    /**
     * @var array HTTP headers
     */
    protected $headers = array();
    /**
     * @var mixed raw server response
     */
    protected $response = null;
    /**
     * HTTP method
     * @var string
     */
    protected $method;
    /**
     * queried URL
     * @var
     */
    protected $url;
    /**
     * request body
     * @var
     */
    protected $body;
    /**
     * query string parameters
     * @var
     */
    protected $query;
    /**
     * response headers
     * @var
     */
    protected $responseHeaders;

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     * @param null $method
     * @param null $url
     * @param array $headers an array with HTTP response headers
     * @param array $query
     * @param array $body
     * @param string $response raw response
     * @param array $responseHeaders
     */
    public function __construct(
        $message = '',
        $code = 0,
        \Exception $previous = null,
        $method = null,
        $url = null,
        $headers = array(),
        $query = array(),
        $body = array(),
        $response = null,
        $responseHeaders = array()
    ){
        $this->headers = $headers;
        $this->response = $response;
        $this->method = $method;
        $this->url = $url;
        $this->body = $body;
        $this->query = $query;
        $this->responseHeaders = $responseHeaders;
        return parent::__construct($message, $code, $previous);
    }

    /**
     * returns headers of HTTP request failed with
     * @return array
     */
    public function getHeaders(){
        return $this->headers;
    }

    /**
     * returns raw response of HTTP request failed with
     * @return mixed|string
     */
    public function getResponse(){
        return $this->response;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    public function __toString()
    {
        $context = var_export([
            'headers'=>$this->headers,
            'body'=>$this->body,
            'method'=>$this->method,
            'query'=>$this->query,
            'response'=>$this->response,
            'responseHeaders'=>$this->responseHeaders,
            'url'=>$this->url
        ], true);

        return sprintf('%d: %s - %s', $this->code, $this->message, $context);
    }
}