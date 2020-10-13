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

use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactoryInterface;

trait ShopDataTrait
{
    /**
     * @var ShopDataFactoryInterface
     */
    private $shopDataFactory;

    /**
     * @var ShopDataFactoryInterface
     */
    private static $globalShopDataFactory;

    /**
     * @return ShopDataFactoryInterface
     */
    protected function getShopDataFactory(): ShopDataFactoryInterface
    {
        if($this->shopDataFactory !== null) {
            return $this->shopDataFactory;
        }

        if(self::$globalShopDataFactory === null) {
            self::$globalShopDataFactory = new ShopDataFactory($this->getGlobalDataFactory());
        }

        return self::$globalShopDataFactory;
    }
}