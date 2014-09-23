<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 11:20
 */

namespace Dreamcommerce\Exceptions;


class HandlerException extends \Exception{
    const ACTION_NOT_EXISTS = 1;
    const ACTION_NOT_SPECIFIED = 2;
    const PAYLOAD_EMPTY = 3;
    const ACTION_HANDLER_NOT_EXISTS = 4;
    const INCORRECT_HANDLER_SPECIFIED = 5;
    const HASH_FAILED = 6;
    const CLIENT_INITIALIZATION_FAILED = 7;

}