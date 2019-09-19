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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Billing\Payload\BillingSubscription;
use DreamCommerce\Component\ShopAppstore\Model\SubscriptionInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface SubscriptionFactoryInterface extends FactoryInterface
{
    /**
     * @param BillingSubscription $billingSubscription
     *
     * @return SubscriptionInterface
     */
    public function createNewByPayload(BillingSubscription $billingSubscription): SubscriptionInterface;
}
