<?php

namespace DreamCommerce\Model\Shop;

interface MetafieldValueInterface extends ShopDependentInterface
{
    /**
     * @return Metafield
     */
    public function getMetafield();

    /**
     * @param MetafieldInterface $metafield
     * @return $this
     */
    public function setMetafield(MetafieldInterface $metafield);
}