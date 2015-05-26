<?php

namespace DreamCommerce\Model\Shop;

interface CurrencyInterface extends ShopDependentInterface
{
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
    public function getPayments();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment);

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments);
}