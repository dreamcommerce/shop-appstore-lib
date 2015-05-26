<?php

namespace DreamCommerce\Model\Shop;

interface AuctionInterface extends ShopDependentInterface
{
    const SALES_FORMAT_BIDDING = 0;
    const SALES_FORMAT_IMMEDIATE = 1;
    const SALES_FORMAT_SHOP = 2;

    /**
     * @return AuctionHouseInterface
     */
    public function getAuctionHouse();

    /**
     * @param AuctionHouseInterface $auctionHouse
     * @return $this
     */
    public function setAuctionHouse(AuctionHouseInterface $auctionHouse);

    /**
     * @return \ArrayAccess
     */
    public function getAuctionOrders();

    /**
     * @param AuctionOrderInterface $auctionOrder
     * @return $this
     */
    public function addAuctionOrder(AuctionOrderInterface $auctionOrder);

    /**
     * @param \ArrayAccess $auctionOrders
     * @return $this
     */
    public function setAuctionOrders($auctionOrders);

    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);

    /**
     * @return ProductStockInterface
     */
    public function getProductStock();

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function setProductStock(ProductStockInterface $productStock);
}