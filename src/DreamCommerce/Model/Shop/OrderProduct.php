<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class OrderProduct implements OrderProductInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $discountPerc;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var \DateTime
     */
    protected $deliveryTime;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $pkwiu;

    /**
     * @var string
     */
    protected $tax;

    /**
     * @var float
     */
    protected $taxValue;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @var string
     */
    protected $option;

    /**
     * @var boolean
     */
    protected $unitFp;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ProductStockInterface
     */
    protected $productStock;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return float
     */
    public function getDiscountPerc()
    {
        return $this->discountPerc;
    }

    /**
     * @param float $discountPerc
     * @return $this
     */
    public function setDiscountPerc($discountPerc)
    {
        $this->discountPerc = $discountPerc;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @param \DateTime $deliveryTime
     * @return $this
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
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
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param string $tax
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxValue()
    {
        return $this->taxValue;
    }

    /**
     * @param float $taxValue
     * @return $this
     */
    public function setTaxValue($taxValue)
    {
        $this->taxValue = $taxValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return $this
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param string $option
     * @return $this
     */
    public function setOption($option)
    {
        $this->option = $option;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isUnitFp()
    {
        return $this->unitFp;
    }

    /**
     * @param boolean $unitFp
     * @return $this
     */
    public function setUnitFp($unitFp)
    {
        $this->unitFp = $unitFp;
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
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
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
     * @return ProductStockInterface
     */
    public function getProductStock()
    {
        return $this->productStock;
    }

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function setProductStock(ProductStockInterface $productStock)
    {
        $this->productStock = $productStock;
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