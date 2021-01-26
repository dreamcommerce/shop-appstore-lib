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

class PromotionCodeResource extends ItemResource implements ObjectAwareResourceInterface
{
    const DISCOUNT_TYPE_PERCENT = 1;
    const DISCOUNT_TYPE_AMOUNT = 2;
    const DISCOUNT_TYPE_FREE_SHIPPING = 3;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'promotion-codes';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'code_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'promotion-code';
    }
}
