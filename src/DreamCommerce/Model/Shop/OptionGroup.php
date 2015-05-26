<?php

namespace DreamCommerce\Model\Shop;

class OptionGroup implements OptionGroupInterface
{
    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var int
     */
    protected $totalProducts;

    /**
     * @var int
     */
    protected $totalStock;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $options;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->options = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalProducts()
    {
        return $this->totalProducts;
    }

    /**
     * @param int $totalProducts
     * @return $this
     */
    public function setTotalProducts($totalProducts)
    {
        $this->totalProducts = $totalProducts;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalStock()
    {
        return $this->totalStock;
    }

    /**
     * @param int $totalStock
     * @return $this
     */
    public function setTotalStock($totalStock)
    {
        $this->totalStock = $totalStock;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(TranslationInterface $translation)
    {
        $this->translations[] = $translation;
        return $this;
    }

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option)
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * @param \ArrayAccess $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}