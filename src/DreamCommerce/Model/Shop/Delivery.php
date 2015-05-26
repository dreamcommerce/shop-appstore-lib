<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Delivery implements DeliveryInterface
{
    /**
     * @var int
     */
    protected $deliveryId;

    /**
     * @var float
     */
    protected $days;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * @param int $deliveryId
     * @return $this
     */
    public function setDeliveryId($deliveryId)
    {
        $this->deliveryId = $deliveryId;
        return $this;
    }

    /**
     * @return float
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param float $days
     * @return $this
     */
    public function setDays($days)
    {
        $this->days = $days;
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