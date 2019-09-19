<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DreamCommerce\Component\Common\Factory\DateTimeFactoryInterface;

class OAuthShop extends Shop implements OAuthShopInterface
{
    use ApplicationDependTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $state;

    /**
     * @var string|null
     */
    private $billingState;

    /**
     * @var string|null
     */
    private $subscriptionState;

    /**
     * @var int|null
     */
    private $version;

    /**
     * @var string|null
     */
    private $authCode;

    /**
     * @var Collection|SubscriptionInterface[]
     */
    private $subscriptions;

    /**
     * @param array $params
     * @param DateTimeFactoryInterface|null $dateTimeFactory
     */
    public function __construct(array $params = array(), ?DateTimeFactoryInterface $dateTimeFactory)
    {
        $this->subscriptions = new ArrayCollection();

        parent::__construct($params, $dateTimeFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function setBillingState(?string $billingState): void
    {
        $this->billingState = $billingState;
    }

    /**
     * {@inheritdoc}
     */
    public function getBillingState(): ?string
    {
        return $this->billingState;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubscriptionState(?string $subscriptionState): void
    {
        $this->subscriptionState = $subscriptionState;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscriptionState(): ?string
    {
        return $this->subscriptionState;
    }

    /**
     * {@inheritdoc}
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    /**
     * {@inheritdoc}
     */
    public function hasSubscription(SubscriptionInterface $subscription): bool
    {
        return $this->subscriptions->contains($subscription);
    }

    /**
     * {@inheritdoc}
     */
    public function addSubscription(SubscriptionInterface $subscription): void
    {
        if (!$this->hasSubscription($subscription)) {
            $subscription->setShop($this);
            $this->subscriptions->add($subscription);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeSubscription(SubscriptionInterface $subscription): void
    {
        if ($this->hasSubscription($subscription)) {
            $subscription->setShop(null);
            $this->subscriptions->removeElement($subscription);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion(?int $version): void
    {
        $this->version = $version;
    }

    /**
     * @return null|string
     */
    public function getAuthCode(): ?string
    {
        return $this->authCode;
    }

    /**
     * @param null|string $authCode
     */
    public function setAuthCode(?string $authCode): void
    {
        $this->authCode = $authCode;
    }
}
