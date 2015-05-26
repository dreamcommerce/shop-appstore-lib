<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Shipping implements ShippingInterface
{
    /**
     * @var int
     */
    protected $shippingId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var int
     */
    protected $dependOnW;

    /**
     * @var float
     */
    protected $maxWeight;

    /**
     * @var float
     */
    protected $minWeight;

    /**
     * @var float
     */
    protected $freeShipping;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var boolean
     */
    protected $isDefault;

    /**
     * @var string
     */
    protected $pkwiu;

    /**
     * @var float
     */
    protected $maxCost;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var TaxInterface
     */
    protected $tax;

    /**
     * @var \ArrayAccess
     */
    protected $ranges;

    /**
     * @var \ArrayAccess
     */
    protected $payments;

    /**
     * @var \ArrayAccess
     */
    protected $gauges;

    /**
     * @var array
     */
    protected $countries;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->ranges = new \ArrayObject();
        $this->payments = new \ArrayObject();
        $this->gauges = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }

    /**
     * @param int $shippingId
     * @return $this
     */
    public function setShippingId($shippingId)
    {
        $this->shippingId = $shippingId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return int
     */
    public function getDependOnW()
    {
        return $this->dependOnW;
    }

    /**
     * @param int $dependOnW
     * @return $this
     */
    public function setDependOnW($dependOnW)
    {
        $this->dependOnW = $dependOnW;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param float $maxWeight
     * @return $this
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinWeight()
    {
        return $this->minWeight;
    }

    /**
     * @param float $minWeight
     * @return $this
     */
    public function setMinWeight($minWeight)
    {
        $this->minWeight = $minWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getFreeShipping()
    {
        return $this->freeShipping;
    }

    /**
     * @param float $freeShipping
     * @return $this
     */
    public function setFreeShipping($freeShipping)
    {
        $this->freeShipping = $freeShipping;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param boolean $isDefault
     * @return $this
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * @return string
     */
    public function getPkwiu()
    {
        return $this->pkwiu;
    }

    /**
     * @param string $pkwiu
     * @return $this
     */
    public function setPkwiu($pkwiu)
    {
        $this->pkwiu = $pkwiu;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * @param float $maxCost
     * @return $this
     */
    public function setMaxCost($maxCost)
    {
        $this->maxCost = $maxCost;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getRanges()
    {
        return $this->ranges;
    }

    /**
     * @param ShippingRange $range
     * @return $this
     */
    public function addRange(ShippingRange $range)
    {
        $this->ranges[] = $range;
        return $this;
    }

    /**
     * @param \ArrayAccess $ranges
     * @return $this
     */
    public function setRanges($ranges)
    {
        $this->ranges = $ranges;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment)
    {
        $this->payments[] = $payment;
        return $this;
    }

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getGauges()
    {
        return $this->gauges;
    }

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function addGauge(GaugeInterface $gauge)
    {
        $this->gauges[] = $gauge;
        return $this;
    }

    /**
     * @param \ArrayAccess $gauges
     * @return $this
     */
    public function setGauges($gauges)
    {
        $this->gauges = $gauges;
        return $this;
    }

    /**
     * @return array
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param array $countries
     * @return $this
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $this;
    }
}