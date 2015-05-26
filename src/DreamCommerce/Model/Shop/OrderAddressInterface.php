<?php

namespace DreamCommerce\Model\Shop;

interface OrderAddressInterface extends AddressInterface
{
    const ADDRESS_TYPE_BILLING = 1;
    const ADDRESS_TYPE_DELIVERY = 2;

    /**
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order);
}