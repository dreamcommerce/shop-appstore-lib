<?php

namespace DreamCommerce\Model\Shop;

interface CategoryTranslationInterface extends TranslationInterface
{
    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function setCategory(CategoryInterface $category);

    /**
     * @return \ArrayAccess
     */
    public function getAttributeGroups();

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function addAttributeGroup(AttributeGroupInterface $attributeGroup);

    /**
     * @param \ArrayAccess $attributeGroups
     * @return $this
     */
    public function setAttributeGroups($attributeGroups);

    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product);

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}