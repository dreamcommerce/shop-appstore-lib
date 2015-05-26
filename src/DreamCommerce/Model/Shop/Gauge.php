<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Gauge implements GaugeInterface
{
    /**
     * @var int
     */
    protected $gaugeId;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $shippings;

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
        $this->shippings = new \ArrayObject();
        $this->products = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getGaugeId()
    {
        return $this->gaugeId;
    }

    /**
     * @param int $gaugeId
     * @return $this
     */
    public function setGaugeId($gaugeId)
    {
        $this->gaugeId = $gaugeId;
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
    public function getShippings()
    {
        return $this->shippings;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function addShipping(ShippingInterface $shipping)
    {
        $this->shippings[] = $shipping;
    }

    /**
     * @param \ArrayAccess $shippings
     * @return $this
     */
    public function setShippings($shippings)
    {
        $this->shippings = $shippings;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
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