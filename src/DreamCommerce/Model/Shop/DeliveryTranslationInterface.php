<?php

namespace DreamCommerce\Model\Shop;

interface DeliveryTranslationInterface extends TranslationInterface
{
    /**
     * @return DeliveryInterface
     */
    public function getDelivery();

    /**
     * @param DeliveryInterface $delivery
     * @return $this
     */
    public function setDelivery(DeliveryInterface $delivery);
}