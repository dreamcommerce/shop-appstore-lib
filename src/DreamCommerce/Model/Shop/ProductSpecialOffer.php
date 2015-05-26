<?php

namespace DreamCommerce\Model\Shop;

abstract class ProductSpecialOffer implements ProductSpecialOfferInterface
{
    /**
     * @var int
     */
    protected $promoId;

    /**
     * @var float
     */
    protected $discount;

    /**
     * @var \DateTime
     */
    protected $dateFrom;

    /**
     * @var \DateTime
     */
    protected $dateTo;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @return int
     */
    public function getPromoId()
    {
        return $this->promoId;
    }

    /**
     * @param int $promoId
     * @return $this
     */
    public function setPromoId($promoId)
    {
        $this->promoId = $promoId;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTime $dateFrom
     * @return $this
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTime $dateTo
     * @return $this
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
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
}
