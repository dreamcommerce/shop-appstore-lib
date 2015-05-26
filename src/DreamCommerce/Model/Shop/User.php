<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class User implements UserInterface
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var \DateTime
     */
    protected $dateAdd;

    /**
     * @var \DateTime
     */
    protected $lastvisit;

    /**
     * @var string
     */
    protected $verifyEmail;

    /**
     * @var string
     */
    protected $origin;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var float
     */
    protected $discount;

    /**
     * @var boolean
     */
    protected $newsletter;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var \ArrayAccess
     */
    protected $groups;

    /**
     * @var \ArrayAccess
     */
    protected $addresses;

    /**
     * @var \ArrayAccess
     */
    protected $additionalFields;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->addresses = new \ArrayObject();
        $this->additionalFields = new \ArrayObject();
        $this->groups = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * @param \DateTime $dateAdd
     * @return $this
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastvisit()
    {
        return $this->lastvisit;
    }

    /**
     * @param \DateTime $lastvisit
     * @return $this
     */
    public function setLastvisit($lastvisit)
    {
        $this->lastvisit = $lastvisit;
        return $this;
    }

    /**
     * @return string
     */
    public function getVerifyEmail()
    {
        return $this->verifyEmail;
    }

    /**
     * @param string $verifyEmail
     * @return $this
     */
    public function setVerifyEmail($verifyEmail)
    {
        $this->verifyEmail = $verifyEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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
     * @return boolean
     */
    public function isNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @param boolean $newsletter
     * @return $this
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
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
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
     * @param UserGroupInterface $group
     * @return $this
     */
    public function addGroup(UserGroupInterface $group)
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
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param UserAddressInterface $address
     * @return $this
     */
    public function addAddress(UserAddressInterface $address)
    {
        $this->addresses[] = $address;
        return $this;
    }

    /**
     * @param \ArrayAccess $addresses
     * @return $this
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAdditionalFields()
    {
        return $this->additionalFields;
    }

    /**
     * @param UserAdditionalFieldInterface $additionalField
     * @return $this
     */
    public function addAdditionalField(UserAdditionalFieldInterface $additionalField)
    {
        $this->additionalFields[] = $additionalField;
        return $this;
    }

    /**
     * @param \ArrayAccess $additionalFields
     * @return $this
     */
    public function setAdditionalFields($additionalFields)
    {
        $this->additionalFields = $additionalFields;
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