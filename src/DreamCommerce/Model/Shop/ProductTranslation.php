<?php

namespace DreamCommerce\Model\Shop;

class ProductTranslation implements ProductTranslationInterface
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
    protected $shortDescription;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $isdefault;

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
     * @var int
     */
    protected $order;

    /**
     * @var boolean
     */
    protected $mainPage;

    /**
     * @var int
     */
    protected $mainPageOrder;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var \ArrayAccess
     */
    protected $files;

    public function __construct()
    {
        $this->files = new \ArrayObject();
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
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     * @return $this
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
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
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * @param boolean $isdefault
     * @return $this
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;
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
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isMainPage()
    {
        return $this->mainPage;
    }

    /**
     * @param boolean $mainPage
     * @return $this
     */
    public function setMainPage($mainPage)
    {
        $this->mainPage = $mainPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getMainPageOrder()
    {
        return $this->mainPageOrder;
    }

    /**
     * @param int $mainPageOrder
     * @return $this
     */
    public function setMainPageOrder($mainPageOrder)
    {
        $this->mainPageOrder = $mainPageOrder;
        return $this;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
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
     * @return \ArrayAccess
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param ProductFileInterface $file
     * @return $this
     */
    public function addFile(ProductFileInterface $file)
    {
        $this->files[] = $file;
        return $this;
    }

    /**
     * @param \ArrayAccess $files
     * @return $this
     */
    public function setFiles($files)
    {
        $this->files = $files;
        return $this;
    }
}