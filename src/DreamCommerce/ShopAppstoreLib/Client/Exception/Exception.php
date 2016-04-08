<?php

namespace DreamCommerce\ShopAppstoreLib\Client\Exception;

use DreamCommerce\ShopAppstoreLib\Exception\Exception as BaseException;

/**
 * Class ClientException
 * @package DreamCommerce
 */
class Exception extends BaseException
{
    /**
     * error occurs when cannot determine more detailed information
     */
    const UNKNOWN_ERROR = 1;

    /**
     * specified URL is invalid
     */
    const ENTRYPOINT_URL_INVALID = 2;

    /**
     * server responded with some error, see exception's message
     */
    const API_ERROR = 3;

    /**
     * you specified something else than get, post, put, delete
     */
    const METHOD_NOT_SUPPORTED = 4;

    const PARAMETER_NOT_SPECIFIED = 5;

    /**
     * @var string
     */
    protected $httpError;

    /**
     * @see \Exception
     * @param string|array $params
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($params = "", $code = 0, \Exception $previous = null)
    {
        if(is_array($params)) {
            if(isset($params['http_error'])) {
                $this->httpError = $params['http_error'];
            }

            $message = 'General failure';
            if(isset($message['message'])) {
                $message = $message['message'];
            }

            parent::__construct($message, $code, $previous);
        } else {
            parent::__construct($params, $code, $previous);
        }
    }

    /**
     * @return string
     */
    public function getHttpError()
    {
        return $this->httpError;
    }
}