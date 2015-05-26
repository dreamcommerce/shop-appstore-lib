<?php

namespace DreamCommerce\Model\Shop;

class OrderAdditionalField extends AdditionalField implements  OrderAdditionalFieldInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

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