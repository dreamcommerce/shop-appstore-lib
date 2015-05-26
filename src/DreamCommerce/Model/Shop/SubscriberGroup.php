<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class SubscriberGroup implements SubscriberGroupInterface
{
    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $autoAdd;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var \ArrayAccess
     */
    protected $subscribers;

    public function __construct()
    {
        $this->subscribers = new \ArrayObject();
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
    public function isAutoAdd()
    {
        return $this->autoAdd;
    }

    /**
     * @param boolean $autoAdd
     * @return $this
     */
    public function setAutoAdd($autoAdd)
    {
        $this->autoAdd = $autoAdd;
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

    /**
     * @return \ArrayAccess
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param SubscriberInterface $subscriber
     * @return $this
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
        return $this;
    }

    /**
     * @param \ArrayAccess $subscribers
     * @return $this
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }
}