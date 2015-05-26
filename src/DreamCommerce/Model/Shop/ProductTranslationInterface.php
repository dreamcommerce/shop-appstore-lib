<?php

namespace DreamCommerce\Model\Shop;

interface ProductTranslationInterface extends TranslationInterface
{
    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return ProductInterface
     */
    public function getProduct();
}