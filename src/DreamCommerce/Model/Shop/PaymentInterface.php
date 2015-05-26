<?php

namespace DreamCommerce\Model\Shop;

interface PaymentInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getCurrencies();

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function addCurrency(CurrencyInterface $currency);

    /**
     * @param \ArrayAccess $currencies
     * @return $this
     */
    public function setCurrencies($currencies);

    /**
     * @return \ArrayAccess
     */
    public function getOrders();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function addOrder(OrderInterface $order);

    /**
     * @param \ArrayAccess $orders
     * @return $this
     */
    public function setOrders($orders);

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
     * @param \ArrayAccess $shipping
     * @return $this
     */
    public function setShippings($shipping);
}