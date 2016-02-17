<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Auction
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/auctions
 */
class Auction extends Resource
{
    /**
     * auction is bid-based
     */
    const SALES_FORMAT_BIDDING = 0;
    /**
     * "buy now"
     */
    const SALES_FORMAT_IMMEDIATE = 1;
    /**
     * treat auction just like a shop
     */
    const SALES_FORMAT_SHOP = 2;

    protected $name = 'auctions';
}