<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Availability implements AvailabilityInterface
{
    /**
     * @var int
     */
    protected $availabilityId;

    /**
     * @var boolean
     */
    protected $canBuy;

    /**
     * @var string
     */
    protected $photo;

    /**
     * @var boolean
     */
    protected $ranges;

    /**
     * @var int|null
     */
    protected $from;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $productStocks;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->productStocks = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getAvailabilityId()
    {
        return $this->availabilityId;
    }

    /**
     * @param int $availabilityId
     * @return $this
     */
    public function setAvailabilityId($availabilityId)
    {
        $this->availabilityId = $availabilityId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCanBuy()
    {
        return $this->canBuy;
    }

    /**
     * @param boolean $canBuy
     * @return $this
     */
    public function setCanBuy($canBuy)
    {
        $this->canBuy = $canBuy;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRanges()
    {
        return $this->ranges;
    }

    /**
     * @param boolean $ranges
     * @return $this
     */
    public function setRanges($ranges)
    {
        $this->ranges = $ranges;
        return $this;
    }

    /**
     * @return int|null
     * @return $this
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param int|null $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
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
     * @param TranslationInterface $translation
     * @return $this
     */
    public function addTranslation(TranslationInterface $translation)
    {
        $this->translations[] = $translation;
        return $this;
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
    public function getProductStocks()
    {
        return $this->productStocks;
    }

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function addProductStock(ProductStockInterface $productStock)
    {
        $this->productStocks[] = $productStock;
        return $this;
    }

    /**
     * @param \ArrayAccess $productStocks
     * @return $this
     */
    public function setProductStocks($productStocks)
    {
        $this->productStocks = $productStocks;
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