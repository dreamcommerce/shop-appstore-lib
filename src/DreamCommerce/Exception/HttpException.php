<?php

namespace DreamCommerce\Exception;

use DreamCommerce\Exception;

/**
 * Class HttpException
 * @package DreamCommerce\Exception
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
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     * @param array $headers an array with HTTP response headers
     * @param string $response raw response
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, $headers = array(), $response = ''){
        $this->headers = $headers;
        $this->response = $response;
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
}