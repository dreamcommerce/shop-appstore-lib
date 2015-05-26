<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Payment implements PaymentInterface
{
    /**
     * @var int
     */
    protected $paymentId;

    /**
     * @var boolean
     */
    protected $install;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $currencies;

    /**
     * @var \ArrayAccess
     */
    protected $orders;

    /**
     * @var \ArrayAccess
     */
    protected $shippings;

    public function __construct()
    {
        $this->orders = new \ArrayObject();
        $this->shippings = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param int $paymentId
     * @return $this
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isInstall()
    {
        return $this->install;
    }

    /**
     * @param boolean $install
     * @return $this
     */
    public function setInstall($install)
    {
        $this->install = $install;
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
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function addCurrency(CurrencyInterface $currency)
    {
        $this->currencies[] = $currency;
        return $this;
    }

    /**
     * @param \ArrayAccess $currencies
     * @return $this
     */
    public function setCurrencies($currencies)
    {
        $this->currencies = $currencies;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function addOrder(OrderInterface $order)
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @param \ArrayAccess $orders
     * @return $this
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
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
        return $this;
    }

    /**
     * @param \ArrayAccess $shipping
     * @return $this
     */
    public function setShippings($shipping)
    {
        $this->shippings = $shipping;
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