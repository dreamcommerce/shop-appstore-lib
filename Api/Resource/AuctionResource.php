<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

class AuctionResource extends ItemResource implements ObjectAwareResourceInterface
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

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'auctions';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'auction_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'auction';
    }
}
