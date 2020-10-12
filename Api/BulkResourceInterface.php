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

namespace DreamCommerce\Component\ShopAppstore\Api;

use DreamCommerce\Component\ShopAppstore\Api\ResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

interface BulkResourceInterface extends ResourceInterface
{
    /**
     * @param ShopInterface $shop
     * @param BulkContainerInterface $container
     * @return BulkResult
     */
    public function execute(ShopInterface $shop, BulkContainerInterface $container): BulkResult;
}