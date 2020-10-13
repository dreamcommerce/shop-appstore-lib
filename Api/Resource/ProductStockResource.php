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

class ProductStockResource extends ItemResource implements ObjectAwareInterface
{
    /**
     * keep base price
     */
    const PRICE_TYPE_KEEP = 0;

    /**
     * specify price for stock
     */
    const PRICE_TYPE_NEW = 1;

    /**
     * increase base price
     */
    const PRICE_TYPE_INCREASE = 2;

    /**
     * dreacrease base price
     */
    const PRICE_TYPE_DECREASE = 3;

    /**
     * keep base weight
     */
    const WEIGHT_TYPE_KEEP = 0;

    /**
     * specify weight for stock
     */
    const WEIGHT_TYPE_NEW = 1;

    /**
     * increase base weight
     */
    const WEIGHT_TYPE_INCREASE = 2;

    /**
     * decrease base weight
     */
    const WEIGHT_TYPE_DECREASE = 3;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'product-stocks';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'stock_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'product-stock';
    }
}