<?php

namespace DreamCommerce\Model\Shop;

interface AvailabilityInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getProductStocks();

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function addProductStock(ProductStockInterface $productStock);

    /**
     * @param \ArrayAccess $productStocks
     * @return $this
     */
    public function setProductStocks($productStocks);
}