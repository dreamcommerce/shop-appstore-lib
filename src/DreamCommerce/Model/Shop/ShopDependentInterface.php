<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

interface ShopDependentInterface
{
    /**
     * @return ShopInterface
     */
    public function getShop();

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);
}