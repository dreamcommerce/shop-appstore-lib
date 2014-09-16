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

} 