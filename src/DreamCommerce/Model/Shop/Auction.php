<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Auction implements AuctionInterface
{
    /**
     * @var int
     */
    protected $auctionId;

    /**
     * @var int
     */
    protected $realAuctionId;

    /**
     * @var int
     */
    protected $salesFormat;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var \DateTime
     */
    protected $startTime;

    /**
     * @var \DateTime
     */
    protected $endTime;

    /**
     * @var float
     */
    protected $startPrice;

    /**
     * @var float
     */
    protected $buyNowPrice;

    /**
     * @var float
     */
    protected $minPrice;

    /**
     * @var float
     */
    protected $bestPrice;

    /**
     * @var int
     */
    protected $views;

    /**
     * @var int
     */
    protected $bids;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var \DateTime
     */
    protected $statusTime;

    /**
     * @var boolean
     */
    protected $finished;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var ProductStockInterface
     */
    protected $productStock;

    /**
     * @var AuctionHouseInterface
     */
    protected $auctionHouse;

    /**
     * @var \ArrayAccess
     */
    protected $auctionOrders;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->auctionOrders = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getAuctionId()
    {
        return $this->auctionId;
    }

    /**
     * @param int $auctionId
     * @return $this
     */
    public function setAuctionId($auctionId)
    {
        $this->auctionId = $auctionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getRealAuctionId()
    {
        return $this->realAuctionId;
    }

    /**
     * @param int $realAuctionId
     * @return $this
     */
    public function setRealAuctionId($realAuctionId)
    {
        $this->realAuctionId = $realAuctionId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSalesFormat()
    {
        return $this->salesFormat;
    }

    /**
     * @param int $salesFormat
     * @return $this
     */
    public function setSalesFormat($salesFormat)
    {
        $this->salesFormat = $salesFormat;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
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
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param \DateTime $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param \DateTime $endTime
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @return float
     */
    public function getStartPrice()
    {
        return $this->startPrice;
    }

    /**
     * @param float $startPrice
     * @return $this
     */
    public function setStartPrice($startPrice)
    {
        $this->startPrice = $startPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getBuyNowPrice()
    {
        return $this->buyNowPrice;
    }

    /**
     * @param float $buyNowPrice
     * @return $this
     */
    public function setBuyNowPrice($buyNowPrice)
    {
        $this->buyNowPrice = $buyNowPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param float $minPrice
     * @return $this
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getBestPrice()
    {
        return $this->bestPrice;
    }

    /**
     * @param float $bestPrice
     * @return $this
     */
    public function setBestPrice($bestPrice)
    {
        $this->bestPrice = $bestPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param int $views
     * @return $this
     */
    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }

    /**
     * @return int
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * @param int $bids
     * @return $this
     */
    public function setBids($bids)
    {
        $this->bids = $bids;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStatusTime()
    {
        return $this->statusTime;
    }

    /**
     * @param \DateTime $statusTime
     * @return $this
     */
    public function setStatusTime($statusTime)
    {
        $this->statusTime = $statusTime;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFinished()
    {
        return $this->finished;
    }

    /**
     * @param boolean $finished
     * @return $this
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
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
     * @return AuctionHouseInterface
     */
    public function getAuctionHouse()
    {
        return $this->auctionHouse;
    }

    /**
     * @param AuctionHouseInterface $auctionHouse
     * @return $this
     */
    public function setAuctionHouse(AuctionHouseInterface $auctionHouse)
    {
        $this->auctionHouse = $auctionHouse;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAuctionOrders()
    {
        return $this->auctionOrders;
    }

    /**
     * @param AuctionOrderInterface $auctionOrder
     * @return $this
     */
    public function addAuctionOrder(AuctionOrderInterface $auctionOrder)
    {
        $this->auctionOrders[] = $auctionOrder;
        return $this;
    }

    /**
     * @param \ArrayAccess $auctionOrders
     * @return $this
     */
    public function setAuctionOrders($auctionOrders)
    {
        $this->auctionOrders = $auctionOrders;
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
