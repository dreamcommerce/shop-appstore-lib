<?php

namespace DreamCommerce\Model\Shop;

interface UnitInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}