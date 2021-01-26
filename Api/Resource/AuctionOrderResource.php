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

class AuctionOrderResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * The order has already been connected to the auction
     */
    const HTTP_ERROR_AUCTION_ORDER_ALREADY_CONNECTED = 'auction_order_already_connected';

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'auction-orders';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'auction_order_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'auction-order';
    }
}
