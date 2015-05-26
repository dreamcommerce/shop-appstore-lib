<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class UserGroup implements UserGroupInterface
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
     * @var float
     */
    protected $discount;

    /**
     * @var \ArrayAccess
     */
    protected $users;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->users = new \ArrayObject();
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
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;
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