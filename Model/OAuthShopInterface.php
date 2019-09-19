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

use Doctrine\Common\Collections\Collection;

interface OAuthShopInterface extends ShopInterface, ApplicationDependInterface
{
    public const STATE_NEW = 'new';
    public const STATE_UNINSTALLED = 'uninstalled';
    public const STATE_PREFETCH_TOKENS = 'prefetch_tokens';
    public const STATE_REJECTED_AUTH_CODE = 'rejected_auth_code';
    public const STATE_INSTALLED = 'installed';

    public const STATE_BILLING_UNPAID = 'unpaid';
    public const STATE_BILLING_PAID = 'paid';
    public const STATE_BILLING_REFUNDED = 'refunded';
    public const STATE_BILLING_CANCELLED = 'cancelled';

    public const STATE_SUBSCRIPTION_UNPAID = 'unpaid';
    public const STATE_SUBSCRIPTION_PAID = 'paid';
    public const STATE_SUBSCRIPTION_EXPIRED = 'expired';

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getState(): ?string;

    /**
     * @param string|null $state
     */
    public function setState(?string $state): void;

    /**
     * @return string|null
     */
    public function getBillingState(): ?string;

    /**
     * @param string|null $billingState
     */
    public function setBillingState(?string $billingState): void;

    /**
     * @return string|null
     */
    public function getSubscriptionState(): ?string;

    /**
     * @param string|null $subscriptionState
     */
    public function setSubscriptionState(?string $subscriptionState): void;

    /**
     * @return Collection|SubscriptionInterface[]
     */
    public function getSubscriptions(): Collection;

    /**
     * @param SubscriptionInterface $subscription
     *
     * @return bool
     */
    public function hasSubscription(SubscriptionInterface $subscription): bool;

    /**
     * @param SubscriptionInterface $subscription
     */
    public function addSubscription(SubscriptionInterface $subscription): void;

    /**
     * @param SubscriptionInterface $subscription
     */
    public function removeSubscription(SubscriptionInterface $subscription): void;

    /**
     * @return int|null
     */
    public function getVersion(): ?int;

    /**
     * @param int|null $version
     */
    public function setVersion(?int $version): void;

    /**
     * @return null|string
     */
    public function getAuthCode(): ?string;

    /**
     * @param null|string $authCode
     */
    public function setAuthCode(?string $authCode): void;
}
