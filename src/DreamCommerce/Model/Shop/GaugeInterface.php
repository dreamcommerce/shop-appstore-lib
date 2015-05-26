<?php

namespace DreamCommerce\Model\Shop;

interface GaugeInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getShippings();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function addShipping(ShippingInterface $shipping);

    /**
     * @param \ArrayAccess $shippings
     * @return $this
     */
    public function setShippings($shippings);

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