<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class AuctionOrder implements AuctionOrderInterface
{
    /**
     * @var int
     */
    protected $auctionOrderId;

    /**
     * @var int
     */
    protected $realAuctionId;

    /**
     * @var int
     */
    protected $buyerId;

    /**
     * @var \DateTime
     */
    protected $statusTime;

    /**
     * @var \DateTime
     */
    protected $paymentTime;

    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var string
     */
    protected $shipmentMethod;

    /**
     * @var int
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $buyerLogin;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var AuctionInterface
     */
    protected $auction;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return int
     */
    public function getAuctionOrderId()
    {
        return $this->auctionOrderId;
    }

    /**
     * @param int $auctionOrderId
     * @return $this
     */
    public function setAuctionOrderId($auctionOrderId)
    {
        $this->auctionOrderId = $auctionOrderId;
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
    public function getBuyerId()
    {
        return $this->buyerId;
    }

    /**
     * @param int $buyerId
     * @return $this
     */
    public function setBuyerId($buyerId)
    {
        $this->buyerId = $buyerId;
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
     * @return \DateTime
     */
    public function getPaymentTime()
    {
        return $this->paymentTime;
    }

    /**
     * @param \DateTime $paymentTime
     * @return $this
     */
    public function setPaymentTime($paymentTime)
    {
        $this->paymentTime = $paymentTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentMethod()
    {
        return $this->shipmentMethod;
    }

    /**
     * @param string $shipmentMethod
     * @return $this
     */
    public function setShipmentMethod($shipmentMethod)
    {
        $this->shipmentMethod = $shipmentMethod;
        return $this;
    }

    /**
     * @return int
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param int $transactionId
     * @return $this
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyerLogin()
    {
        return $this->buyerLogin;
    }

    /**
     * @param string $buyerLogin
     * @return $this
     */
    public function setBuyerLogin($buyerLogin)
    {
        $this->buyerLogin = $buyerLogin;
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
     * @return AuctionInterface
     */
    public function getAuction()
    {
        return $this->auction;
    }

    /**
     * @param AuctionInterface $auction
     * @return $this
     */
    public function setAuction(AuctionInterface $auction)
    {
        $this->auction = $auction;
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