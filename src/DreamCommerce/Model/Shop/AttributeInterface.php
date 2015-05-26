<?php

namespace DreamCommerce\Model\Shop;

interface AttributeInterface extends ShopDependentInterface
{
    const ATTRIBUTE_TYPE_TEXT = 0;
    const ATTRIBUTE_TYPE_CHECKBOX = 1;
    const ATTRIBUTE_TYPE_SELECT = 2;

    /**
     * @return AttributeGroupInterface
     */
    public function getAttributeGroup();

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function setAttributeGroup(AttributeGroupInterface $attributeGroup);
}