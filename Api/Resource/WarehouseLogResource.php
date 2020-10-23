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

class WarehouseLogResource extends ItemResource implements ObjectAwareInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'warehouse-logs';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'log_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'warehouse-log';
    }
}