<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Attribute implements AttributeInterface
{
    /**
     * @var int
     */
    protected $attributeId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $default;

    /**
     * @var AttributeGroupInterface
     */
    protected $attributeGroup;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return int
     */
    public function getAttributeId()
    {
        return $this->attributeId;
    }

    /**
     * @param int $attributeId
     * @return $this
     */
    public function setAttributeId($attributeId)
    {
        $this->attributeId = $attributeId;
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
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
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
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @param boolean $default
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return AttributeGroupInterface
     */
    public function getAttributeGroup()
    {
        return $this->attributeGroup;
    }

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function setAttributeGroup(AttributeGroupInterface $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;
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