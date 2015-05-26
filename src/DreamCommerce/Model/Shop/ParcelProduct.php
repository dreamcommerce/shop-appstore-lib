<?php

namespace DreamCommerce\Model\Shop;

class ParcelProduct implements ParcelProductInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $quantity;

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
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ProductStockInterface
     */
    protected $productStock;

    /**
     * @var ParcelInterface
     */
    protected $parcel;

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
     * @return ParcelInterface
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * @param ParcelInterface $parcel
     * @return $this
     */
    public function setParcel(ParcelInterface $parcel)
    {
        $this->parcel = $parcel;
    }
}