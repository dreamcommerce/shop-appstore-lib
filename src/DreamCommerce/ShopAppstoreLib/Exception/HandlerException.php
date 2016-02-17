<?php

namespace DreamCommerce\ShopAppstoreLib\Exception;

use DreamCommerce\ShopAppstoreLib\Exception;

/**
 * Class HandlerException
 * @package DreamCommerce\ShopAppstoreLib\Exception
 */
class HandlerException extends Exception
{
    /**
     * tried to bind to action which doesn't exist
     */
    const ACTION_NOT_EXISTS = 1;
    /**
     * forgot to specify action
     */
    const ACTION_NOT_SPECIFIED = 2;
    /**
     * server made request with no payload
     */
    const PAYLOAD_EMPTY = 3;
    /**
     * server requested an action which is not bound
     */
    const ACTION_HANDLER_NOT_EXISTS = 4;
    /**
     * problem with callable
     */
    const INCORRECT_HANDLER_SPECIFIED = 5;
    /**
     * provided hash doesn't match the data
     */
    const HASH_FAILED = 6;
    /**
     * a data specified upon initialization is invalid
     */
    const CLIENT_INITIALIZATION_FAILED = 7;

}