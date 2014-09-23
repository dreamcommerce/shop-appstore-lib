<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2014-09-22
 * Time: 09:31
 */

namespace Dreamcommerce\Exceptions;


class ResourceException extends \Exception{

    const MALFORMED_RESPONSE = 1;
    const CLIENT_ERROR = 2;

} 