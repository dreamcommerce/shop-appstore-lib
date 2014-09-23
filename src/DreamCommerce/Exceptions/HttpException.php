<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:44
 */

namespace Dreamcommerce\Exceptions;


class HttpException extends \Exception{

    const METHOD_NOT_SUPPORTED = 1;
    const REQUEST_FAILED = 2;
    const MALFORMED_RESULT = 3;
    const QUOTA_EXCEEDED = 4;
    const LIMIT_TOO_LOW = 5;

    protected $headers = array();
    protected $response = '';

    public function __construct($msg = '', $code = 0, \Exception $prev = null, $headers = array(), $response = ''){
        $this->headers = $headers;
        $this->response = $response;
        return parent::__construct($msg, $code, $prev);
    }

    public function getHeaders(){
        return $this->headers;
    }

    public function getResponse(){
        return $this->response;
    }
}