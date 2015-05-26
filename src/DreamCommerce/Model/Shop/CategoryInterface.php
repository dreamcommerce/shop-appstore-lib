<?php

namespace DreamCommerce\Model\Shop;

interface CategoryInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product);

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}