<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

abstract class UserAddress extends Address implements UserAddressInterface
{
    /**
     * @var string
     */
    protected $pesel;

    /**
     * @var boolean
     */
    protected $default;

    /**
     * @var boolean
     */
    protected $shippingDefault;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return string
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * @param string $pesel
     * @return $this
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;
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
     * @return boolean
     */
    public function isShippingDefault()
    {
        return $this->shippingDefault;
    }

    /**
     * @param boolean $shippingDefault
     * @return $this
     */
    public function setShippingDefault($shippingDefault)
    {
        $this->shippingDefault = $shippingDefault;
        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
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