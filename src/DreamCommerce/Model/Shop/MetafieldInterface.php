<?php

namespace DreamCommerce\Model\Shop;

interface MetafieldInterface extends ShopDependentInterface
{
    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;
    const TYPE_BLOB = 4;

    const RESOURCE_SYSTEM = 'system';

    /**
     * @return MetafieldValueInterface
     */
    public function getMetafieldValue();

    /**
     * @param MetafieldValueInterface $metafieldValue
     * @return $this
     */
    public function setMetafieldValue(MetafieldValueInterface $metafieldValue);

    /**
     * @return ShopDependentInterface
     */
    public function getObject();

    /**
     * @param ShopDependentInterface $object
     * @return $this
     */
    public function setObject(ShopDependentInterface $object);
}