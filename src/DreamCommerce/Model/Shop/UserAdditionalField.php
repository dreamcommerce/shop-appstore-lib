<?php

namespace DreamCommerce\Model\Shop;

class UserAdditionalField extends AdditionalField implements  UserAdditionalFieldInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
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
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }
}