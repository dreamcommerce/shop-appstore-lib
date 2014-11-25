<?php
namespace DreamCommerce\Exception;
use DreamCommerce\Exception;

/**
 * Class ResourceException
 * @package DreamCommerce\Exception
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

    /**
     * specified limit exceeds range
     */
    const LIMIT_BEYOND_RANGE = 3;

    /**
     * filters in request are unspecified
     */
    const FILTERS_NOT_SPECIFIED = 4;

    /**
     * cannot parse ordering rule
     */
    const ORDER_NOT_SUPPORTED = 5;

    /**
     * caused when dev uses filter in unsupported method
     */
    const FILTERS_IN_UNSUPPORTED_METHOD = 6;

    /**
     * invalid page number
     */
    const INVALID_PAGE = 7;

} 