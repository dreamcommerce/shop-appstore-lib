<?php

namespace DreamCommerce\Model\Shop;

interface SubscriberInterface extends LanguageDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getGroups();

    /**
     * @param SubscriberGroupInterface $group
     * @return $this
     */
    public function addGroup(SubscriberGroupInterface $group);

    /**
     * @param \ArrayAccess $groups
     * @return $this
     */
    public function setGroups($groups);
}