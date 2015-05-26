<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Unit implements UnitInterface
{
    /**
     * @var int
     */
    protected $unitId;

    /**
     * @var boolean
     */
    protected $floatingPoint;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->products = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * @param int $unitId
     * @return $this
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFloatingPoint()
    {
        return $this->floatingPoint;
    }

    /**
     * @param boolean $floatingPoint
     * @return $this
     */
    public function setFloatingPoint($floatingPoint)
    {
        $this->floatingPoint = $floatingPoint;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
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