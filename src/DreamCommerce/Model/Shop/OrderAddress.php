<?php

namespace DreamCommerce\Model\Shop;

abstract class OrderAddress extends Address implements OrderAddressInterface
{
    /**
     * @var int
     */
    protected $type;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
        return $this;
    }
}