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

class CollectionProductResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'collections/:collection_id/products';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'product_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'product';
    }

}
