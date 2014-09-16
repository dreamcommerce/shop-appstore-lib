<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:50
 */

namespace Dreamcommerce\Exceptions;


class ClientException extends \Exception{

    const QUOTA_EXCEEDED = 1;
    const UNKNOWN_ERROR = 2;

} 