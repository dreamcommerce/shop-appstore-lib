<?php

namespace DreamCommerce\Model\Shop;

interface ProductImageInterface extends ShopDependentInterface
{
    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);
}