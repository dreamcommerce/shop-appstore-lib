<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

abstract class Option implements OptionInterface
{
    /**
     * @var int
     */
    protected $optionId;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var OptionGroupInterface
     */
    protected $optionGroup;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * @param int $optionId
     * @return $this
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param TranslationInterface $translation
     * @return $this
     */
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
     * @return OptionGroupInterface
     */
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup(OptionGroupInterface $optionGroup)
    {
        $this->optionGroup = $optionGroup;
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