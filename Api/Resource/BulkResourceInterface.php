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

use DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk\BulkContainerInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk\BulkResultInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

interface BulkResourceInterface extends ResourceInterface
{
    /**
     * @param ShopInterface $shop
     * @param BulkContainerInterface $container
     * @return BulkResultInterface
     */
    public function execute(ShopInterface $shop, BulkContainerInterface $container): BulkResultInterface;
}