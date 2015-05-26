<?php

namespace DreamCommerce\Model\Shop;

interface OrderInterface extends ShopDependentInterface
{
    /**
     * @return CurrencyInterface
     */
    public function getCurrency();

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency($currency);

    /**
     * @return ShippingInterface
     */
    public function getShipping();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping($shipping);

    /**
     * @return PaymentInterface
     */
    public function getPayment();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function setPayment($payment);

    /**
     * @return StatusInterface
     */
    public function getStatus();

    /**
     * @param StatusInterface $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser($user);

    /**
     * @return AuctionOrderInterface
     */
    public function getAuctionOrder();

    /**
     * @param AuctionOrderInterface $auctionOrder
     * @return $this
     */
    public function setAuctionOrder($auctionOrder);

    /**
     * @return OrderAddressInterface
     */
    public function getBillingAddress();

    /**
     * @param OrderAddressInterface $billingAddress
     * @return $this
     */
    public function setBillingAddress($billingAddress);

    /**
     * @return OrderAddressInterface
     */
    public function getDeliveryAddress();

    /**
     * @param OrderAddressInterface $deliveryAddress
     * @return $this
     */
    public function setDeliveryAddress($deliveryAddress);

    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param OrderProductInterface $orderProduct
     * @return $this
     */
    public function addProduct(OrderProductInterface $product);

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);

    /**
     * @return \ArrayAccess
     */
    public function getAdditionalFields();

    /**
     * @param OrderAdditionalFieldInterface $additionalField
     * @return $this
     */
    public function addAdditionalField(OrderAdditionalFieldInterface $additionalField);

    /**
     * @param \ArrayAccess $additionalFields
     * @return $this
     */
    public function setAdditionalFields($additionalFields);
}