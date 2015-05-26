<?php

namespace DreamCommerce\Model\Shop;

interface UserGroupInterface extends ShopDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getUsers();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user);

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users);
}