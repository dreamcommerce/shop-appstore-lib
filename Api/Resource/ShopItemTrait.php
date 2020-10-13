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

use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;

trait ShopItemTrait
{
    /**
     * @var ShopItemFactoryInterface|null
     */
    private $shopItemFactory;

    /**
     * @var ShopItemPartListFactoryInterface|null
     */
    private $shopItemListFactory;

    /**
     * @var ShopItemPartListInterface|null
     */
    private $shopItemPartListFactory;

    /**
     * @var ShopItemFactoryInterface|null
     */
    private static $globalItemFactory;

    /**
     * @var ShopItemListFactoryInterface|null
     */
    private static $globalItemListFactory;

    /**
     * @var ShopItemPartListFactoryInterface|null
     */
    private static $globalItemPartListFactory;

    /**
     * @return ShopItemFactoryInterface
     */
    protected function getShopItemFactory(): ShopItemFactoryInterface
    {
        if($this->shopItemFactory !== null) {
            return $this->shopItemFactory;
        }

        if(self::$globalItemFactory === null) {
            self::$globalItemFactory = new ShopItemFactory($this->getGlobalDataFactory());
        }

        return self::$globalItemFactory;
    }

    /**
     * @return ShopItemListFactoryInterface
     */
    protected function getShopItemListFactory(): ShopItemListFactoryInterface
    {
        if($this->shopItemListFactory !== null) {
            return $this->shopItemListFactory;
        }

        if(self::$globalItemListFactory === null) {
            self::$globalItemListFactory = new ShopItemListFactory();
        }

        return self::$globalItemListFactory;
    }

    /**
     * @return ShopItemPartListFactoryInterface
     */
    protected function getShopItemPartListFactory(): ShopItemPartListFactoryInterface
    {
        if($this->shopItemPartListFactory !== null) {
            return $this->shopItemPartListFactory;
        }

        if(self::$globalItemPartListFactory === null) {
            self::$globalItemPartListFactory = new ShopItemPartListFactory($this->getShopItemFactory());
        }

        return self::$globalItemPartListFactory;
    }
}