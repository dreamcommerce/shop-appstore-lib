<?php

namespace DreamCommerce\Model\Shop;

interface ParcelInterface extends ShopDependentInterface
{
    /**
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order);

    /**
     * @return ShippingInterface
     */
    public function getShipping();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping(ShippingInterface $shipping);

    /**
     * @return ParcelAddressInterface
     */
    public function getDeliveryAddress();

    /**
     * @param ParcelAddressInterface $deliveryAddress
     * @return $this
     */
    public function setDeliveryAddress(ParcelAddressInterface $deliveryAddress);

    /**
     * @return ParcelAddressInterface
     */
    public function getBillingAddress();

    /**
     * @param ParcelAddressInterface $billingAddress
     * @return $this
     */
    public function setBillingAddress(ParcelAddressInterface $billingAddress);

    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param ParcelProductInterface $product
     * @return $this
     */
    public function addProduct(ParcelProductInterface $product);

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}