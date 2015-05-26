<?php

namespace DreamCommerce\Model\Shop;

interface StatusInterface extends TranslationDependentInterface, ShopDependentInterface
{
    const STATUS_TYPE_NEW = 1;
    const STATUS_TYPE_OPENED = 2;
    const STATUS_TYPE_CLOSED = 3;
    const STATUS_TYPE_NOT_COMPLETED = 4;

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
}