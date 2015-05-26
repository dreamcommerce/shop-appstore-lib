<?php

namespace DreamCommerce\Model\Shop;

interface UserAdditionalFieldInterface extends AdditionalFieldInterface
{
    const LOCATE_USER = 1;
    const LOCATE_USER_ACCOUNT = 2;
    const LOCATE_USER_REGISTRATION = 4;

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user);
}