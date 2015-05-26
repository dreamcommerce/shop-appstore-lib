<?php

namespace DreamCommerce\Model\Shop;

interface SubscriberGroupInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getSubscribers();

    /**
     * @param SubscriberInterface $subscriber
     * @return $this
     */
    public function addSubscriber(SubscriberInterface $subscriber);

    /**
     * @param \ArrayAccess $subscribers
     * @return $this
     */
    public function setSubscribers($subscribers);
}