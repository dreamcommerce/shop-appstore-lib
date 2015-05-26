<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class ProductImage implements ProductImageInterface
{
    /**
     * @var int
     */
    protected $gfxId;

    /**
     * @var boolean
     */
    protected $main;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $unicName;

    /**
     * @var boolean
     */
    protected $hidden;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return int
     */
    public function getGfxId()
    {
        return $this->gfxId;
    }

    /**
     * @param int $gfxId
     * @return $this
     */
    public function setGfxId($gfxId)
    {
        $this->gfxId = $gfxId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isMain()
    {
        return $this->main;
    }

    /**
     * @param boolean $main
     * @return $this
     */
    public function setMain($main)
    {
        $this->main = $main;
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
     * @return string
     */
    public function getUnicName()
    {
        return $this->unicName;
    }

    /**
     * @param string $unicName
     * @return $this
     */
    public function setUnicName($unicName)
    {
        $this->unicName = $unicName;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * @param boolean $hidden
     * @return $this
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
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