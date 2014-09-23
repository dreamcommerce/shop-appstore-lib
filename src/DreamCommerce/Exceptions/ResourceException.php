<?php
namespace Dreamcommerce\Exceptions;

/**
 * Class ResourceException
 * @package Dreamcommerce\Exceptions
 */
class ResourceException extends \Exception{

    /**
     * cannot parse server response
     */
    const MALFORMED_RESPONSE = 1;
    /**
     * other client error, look into previous exception and {@link ClientException}
     */
    const CLIENT_ERROR = 2;

} 