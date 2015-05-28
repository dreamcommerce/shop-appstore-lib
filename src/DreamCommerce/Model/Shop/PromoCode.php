<?php

namespace DreamCommerce\Model\Shop;

class PromoCode implements PromoCodeInterface
{
    protected $codeId;

    // TODO

    /**
     * @var \ArrayAccess
     */
    protected $orders;

    /**
     * @return \ArrayAccess
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function addOrder(OrderInterface $order)
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @param \ArrayAccess $orders
     * @return $this
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
        return $this;
    }
}