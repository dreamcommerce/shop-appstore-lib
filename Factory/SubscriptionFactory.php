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

class SubscriptionFactory implements SubscriptionFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): SubscriptionInterface
    {
        return $this->factory->createNew();
    }

    /**
     * @param BillingSubscription $billingSubscription
     *
     * @return SubscriptionInterface
     */
    public function createNewByPayload(BillingSubscription $billingSubscription): SubscriptionInterface
    {
        $object = $this->createNew();
        $object->setShop($billingSubscription->getShop());
        $object->setExpiresAt($billingSubscription->getSubscriptionEndTime());

        return $object;
    }
}
