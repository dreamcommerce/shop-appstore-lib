<?php

namespace DreamCommerce\Model\Shop;

interface ProductStockInterface extends ShopDependentInterface
{
    const PRICE_TYPE_NO_VALUE = 0;
    const PRICE_TYPE_NEW_VALUE = 1;
    const PRICE_TYPE_INCREASE_VALUE = 2;
    const PRICE_TYPE_DECREASE_VALUE = 3;

    const WEIGHT_TYPE_NO_VALUE = 0;
    const WEIGHT_TYPE_NEW_VALUE = 1;
    const WEIGHT_TYPE_INCREASE_VALUE = 2;
    const WEIGHT_TYPE_DECREASE_VALUE = 3;

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
     * @return AvailabilityInterface
     */
    public function getAvailability();

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability);

    /**
     * @return DeliveryInterface
     */
    public function getDelivery();

    /**
     * @param DeliveryInterface $delivery
     * @return $this
     */
    public function setDelivery(DeliveryInterface $delivery);
    /**
     * @return ProductImageInterface
     */
    public function getImage();

    /**
     * @param ProductImageInterface $image
     * @return $this
     */
    public function setImage(ProductImageInterface $image);
}