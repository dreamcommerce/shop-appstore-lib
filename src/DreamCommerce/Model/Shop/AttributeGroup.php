<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class AttributeGroup implements AttributeGroupInterface
{
    /**
     * @var int
     */
    protected $attributeGroupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $filters;

    /**
     * @var \ArrayAccess
     */
    protected $categories;

    /**
     * @var \ArrayObject
     */
    protected $attributes;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->categories = new \ArrayObject();
        $this->attributes = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getAttributeGroupId()
    {
        return $this->attributeGroupId;
    }

    /**
     * @param int $attributeGroupId
     * @return $this
     */
    public function setAttributeGroupId($attributeGroupId)
    {
        $this->attributeGroupId = $attributeGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFilters()
    {
        return $this->filters;
    }

    /**
     * @param boolean $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function addCategory(CategoryInterface $category)
    {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * @param \ArrayAccess $categories
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return \ArrayObject
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param AttributeInterface $attribute
     * @return $this
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $this->attributes[] = $attribute;
        return $this;
    }

    /**
     * @param \ArrayObject $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $this;
    }
}