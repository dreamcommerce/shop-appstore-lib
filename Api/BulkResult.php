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

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

final class BulkResult
{
    /**
     * @var Bulk\Operation
     */
    private $operation;

    /**
     * @var ShopInterface
     */
    private $shop;

    /**
     * @param Bulk\Operation $operation
     * @param ShopInterface $shop
     */
    public function __construct(Bulk\Operation $operation, ShopInterface $shop)
    {
        $this->operation = $operation;
        $this->shop = $shop;
    }

    /**
     * @return Bulk\Operation
     */
    public function getOperation(): Bulk\Operation
    {
        return $this->operation;
    }

    /**
     * @return ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }
}