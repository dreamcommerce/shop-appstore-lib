<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:50
 */

namespace Dreamcommerce\Exceptions;


class ClientException extends \Exception{

    const UNKNOWN_ERROR = 2;
    const ENTRYPOINT_URL_INVALID = 3;
    const API_ERROR = 4;
    const METHOD_NOT_SUPPORTED = 5;
}