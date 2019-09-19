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

namespace DreamCommerce\Component\ShopAppstore\Billing\Resolver;

use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\BillingSubscription;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Factory\SubscriptionFactoryInterface;
use Webmozart\Assert\Assert;

final class BillingSubscriptionResolver implements ResolverInterface
{
    /**
     * @var SubscriptionFactoryInterface
     */
    private $subscriptionFactory;

    /**
     * @var ObjectManager
     */
    private $subscriptionObjectManager;

    public function __construct(ObjectManager $subscriptionObjectManager, SubscriptionFactoryInterface $subscriptionFactory)
    {
        $this->subscriptionFactory = $subscriptionFactory;
        $this->subscriptionObjectManager = $subscriptionObjectManager;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message): void
    {
        /** @var BillingSubscription $message */
        Assert::isInstanceOf($message, BillingSubscription::class);

        $subscription = $this->subscriptionFactory->createNewByPayload($message);

        $this->subscriptionObjectManager->persist($subscription);
        $this->subscriptionObjectManager->flush();
    }
}
