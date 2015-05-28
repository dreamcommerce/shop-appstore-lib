<?php

namespace DreamCommerce\Model\Shop;

abstract class ProductOption implements ProductOptionInterface
{
    /**
     * @var int
     */
    protected $productOptionId;

    /**
     * @var int
     */
    protected $percent;

    /**
     * @var float
     */
    protected $changePrice;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var OptionInterface
     */
    protected $option;

    /**
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param int $percent
     * @return $this
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * @return float
     */
    public function getChangePrice()
    {
        return $this->changePrice;
    }

    /**
     * @param float $changePrice
     * @return $this
     */
    public function setChangePrice($changePrice)
    {
        $this->changePrice = $changePrice;
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
     * @return OptionInterface
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption(OptionInterface $option)
    {
        $this->option = $option;
        return $this;
    }
}