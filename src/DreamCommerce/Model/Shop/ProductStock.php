<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class ProductStock implements ProductStockInterface
{
    /**
     * @var int
     */
    protected $stockId;

    /**
     * @var boolean
     */
    protected $extended;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var int
     */
    protected $priceType;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $default;

    /**
     * @var float
     */
    protected $stock;

    /**
     * @var float
     */
    protected $warnLevel;

    /**
     * @var float
     */
    protected $sold;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $ean;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var int
     */
    protected $weightType;

    /**
     * @var float
     */
    protected $package;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var AvailabilityInterface
     */
    protected $availability;

    /**
     * @var DeliveryInterface
     */
    protected $delivery;

    /**
     * @var ProductImageInterface
     */
    protected $image;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return int
     */
    public function getStockId()
    {
        return $this->stockId;
    }

    /**
     * @param int $stockId
     * @return $this;
     */
    public function setStockId($stockId)
    {
        $this->stockId = $stockId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isExtended()
    {
        return $this->extended;
    }

    /**
     * @param boolean $extended
     * @return $this
     */
    public function setExtended($extended)
    {
        $this->extended = $extended;
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
     * @return int
     */
    public function getPriceType()
    {
        return $this->priceType;
    }

    /**
     * @param int $priceType
     * @return $this
     */
    public function setPriceType($priceType)
    {
        $this->priceType = $priceType;
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
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param boolean $default
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return float
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param float $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return float
     */
    public function getWarnLevel()
    {
        return $this->warnLevel;
    }

    /**
     * @param float $warnLevel
     * @return $this
     */
    public function setWarnLevel($warnLevel)
    {
        $this->warnLevel = $warnLevel;
        return $this;
    }

    /**
     * @return float
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * @param float $sold
     * @return $this
     */
    public function setSold($sold)
    {
        $this->sold = $sold;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     * @return $this
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeightType()
    {
        return $this->weightType;
    }

    /**
     * @param int $weightType
     * @return $this
     */
    public function setWeightType($weightType)
    {
        $this->weightType = $weightType;
        return $this;
    }

    /**
     * @return float
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param float $package
     * @return $this
     */
    public function setPackage($package)
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return AvailabilityInterface
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability)
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @return DeliveryInterface
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param DeliveryInterface $delivery
     * @return $this
     */
    public function setDelivery(DeliveryInterface $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * @return ProductImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param ProductImageInterface $image
     * @return $this
     */
    public function setImage(ProductImageInterface $image)
    {
        $this->image = $image;
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