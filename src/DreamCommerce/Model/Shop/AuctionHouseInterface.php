<?php

namespace DreamCommerce\Model\Shop;

interface AuctionHouseInterface extends ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getAuctions();

    /**
     * @param AuctionInterface $auction
     * @return $this
     */
    public function addAuction(AuctionInterface $auction);

    /**
     * @param \ArrayAccess $auctions
     * @return $this
     */
    public function setAuctions($auctions);
}