<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource AuctionOrder
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/auction-orders
 */
class AuctionOrder extends Resource
{
    /**
     * The order has already been connected to the auction
     */
    const HTTP_ERROR_AUCTION_ORDER_ALREADY_CONNECTED = 'auction_order_already_connected';

    protected $name = 'auction-orders';
}