<?php

namespace DreamCommerce\Model\Shop;

class CategoryTranslation implements CategoryTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $seoTitle;

    /**
     * @var string
     */
    protected $seoDescription;

    /**
     * @var string
     */
    protected $seoKeywords;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $isdefaults;

    /**
     * @var int
     */
    protected $items;

    /**
     * @var \ArrayAccess
     */
    protected $attributeGroups;

    /**
     * @var CategoryInterface
     */
    protected $category;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    /**
     * @var LanguageInterface
     */
    protected $language;

    public function __construct()
    {
        $this->products = new \ArrayObject();
        $this->attributeGroups = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @param string $seoTitle
     * @return $this
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @param string $seoDescription
     * @return $this
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * @param string $seoKeywords
     * @return $this
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;
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
    public function getIsDefaults()
    {
        return $this->isdefaults;
    }

    /**
     * @param boolean $isdefaults
     * @return $this
     */
    public function setIsdefaults($isdefaults)
    {
        $this->isdefaults = $isdefaults;
        return $this;
    }

    /**
     * @return int
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param int $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAttributeGroups()
    {
        return $this->attributeGroups;
    }

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function addAttributeGroup(AttributeGroupInterface $attributeGroup)
    {
        $this->attributeGroups[] = $attributeGroup;
        return $this;
    }

    /**
     * @param \ArrayAccess $attributeGroups
     * @return $this
     */
    public function setAttributeGroups($attributeGroups)
    {
        $this->attributeGroups = $attributeGroups;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
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
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
        return $this;
    }
}