<?php

namespace DreamCommerce\Model\Shop;

interface OrderAdditionalFieldInterface extends AdditionalFieldInterface
{
    const LOCATE_ORDER = 8;
    const LOCATE_ORDER_WITH_REGISTRATION = 16;
    const LOCATE_ORDER_WITHOUT_REGISTRATION = 32;
    const LOCATE_ORDER_LOGGED_ON_USER = 64;

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