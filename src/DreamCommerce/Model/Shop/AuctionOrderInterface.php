<?php

namespace DreamCommerce\Model\Shop;

interface AuctionOrderInterface extends ShopDependentInterface
{
    /**
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order);

    /**
     * @return AuctionInterface
     */
    public function getAuction();

    /**
     * @param AuctionInterface $auction
     * @return $this
     */
    public function setAuction(AuctionInterface $auction);
}