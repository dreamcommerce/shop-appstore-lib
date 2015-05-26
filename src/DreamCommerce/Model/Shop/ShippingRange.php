<?php

namespace DreamCommerce\Model\Shop;

class ShippingRange implements ShippingRangeInterface
{
    /**
     * @var int
     */
    protected $weightId;

    /**
     * @var float
     */
    protected $from;

    /**
     * @var float
     */
    protected $to;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * @return int
     */
    public function getWeightId()
    {
        return $this->weightId;
    }

    /**
     * @param int $weightId
     * @return $this
     */
    public function setWeightId($weightId)
    {
        $this->weightId = $weightId;
        return $this;
    }

    /**
     * @return float
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param float $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return float
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param float $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return ShippingInterface
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }
}