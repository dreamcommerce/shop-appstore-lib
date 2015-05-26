<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Subscriber implements SubscriberInterface
{
    /**
     * @var int
     */
    protected $subscriberId;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var \DateTime
     */
    protected $dateadd;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var \ArrayAccess
     */
    protected $groups;

    public function __construct()
    {
        $this->groups = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    /**
     * @param int $subscriberId
     * @return $this
     */
    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return \DateTime
     */
    public function getDateadd()
    {
        return $this->dateadd;
    }

    /**
     * @param \DateTime $dateadd
     * @return $this
     */
    public function setDateadd($dateadd)
    {
        $this->dateadd = $dateadd;
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

    /**
     * @return \ArrayAccess
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param SubscriberGroupInterface $group
     * @return $this
     */
    public function addGroup(SubscriberGroupInterface $group)
    {
        $this->groups[] = $group;
        return $this;
    }

    /**
     * @param \ArrayAccess $groups
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
        return $this;
    }
}