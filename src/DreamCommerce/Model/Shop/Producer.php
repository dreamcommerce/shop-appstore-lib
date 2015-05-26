<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Producer implements ProducerInterface
{
    /**
     * @var int
     */
    protected $producerId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $web;

    /**
     * @var string
     */
    protected $gfx;

    /**
     * @var boolean
     */
    protected $isdefault;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    public function __construct()
    {
        $this->products = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getProducerId()
    {
        return $this->producerId;
    }

    /**
     * @param int $producerId
     * @return $this
     */
    public function setProducerId($producerId)
    {
        $this->producerId = $producerId;
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
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param string $web
     * @return $this
     */
    public function setWeb($web)
    {
        $this->web = $web;
        return $this;
    }

    /**
     * @return string
     */
    public function getGfx()
    {
        return $this->gfx;
    }

    /**
     * @param string $gfx
     * @return $this
     */
    public function setGfx($gfx)
    {
        $this->gfx = $gfx;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isdefault;
    }

    /**
     * @param boolean $isdefault
     * @return $this
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;
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