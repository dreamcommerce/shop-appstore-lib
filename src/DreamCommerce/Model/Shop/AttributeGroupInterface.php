<?php

namespace DreamCommerce\Model\Shop;

interface AttributeGroupInterface extends LanguageDependentInterface, ShopDependentInterface
{
    /**
     * @return CategoryInterface
     */
    public function getCategories();

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function addCategory(CategoryInterface $category);

    /**
     * @param \ArrayAccess $categories
     * @return $this
     */
    public function setCategories($categories);

    /**
     * @return \ArrayAccess
     */
    public function getAttributes();

    /**
     * @param AttributeInterface $attribute
     * @return $this
     */
    public function addAttribute(AttributeInterface $attribute);

    /**
     * @param $attributes
     * @return \ArrayAccess
     */
    public function setAttributes($attributes);
}