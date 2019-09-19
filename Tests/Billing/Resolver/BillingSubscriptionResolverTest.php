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

namespace DreamCommerce\Component\ShopAppstore\Tests\Billing\Resolver;

use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\BillingSubscription;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\BillingSubscriptionResolver;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\ResolverInterface;
use DreamCommerce\Component\ShopAppstore\Factory\SubscriptionFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\SubscriptionInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BillingSubscriptionResolverTest extends TestCase
{
    /**
     * @var BillingSubscriptionResolver
     */
    protected $resolver;

    /**
     * @var SubscriptionFactoryInterface|MockObject
     */
    protected $subscriptionFactory;

    /**
     * @var ObjectManager|MockObject
     */
    protected $subscriptionObjectManager;

    public function setUp(): void
    {
        $this->subscriptionFactory = $this->getMockBuilder(SubscriptionFactoryInterface::class)->getMock();
        $this->subscriptionObjectManager = $this->getMockBuilder(ObjectManager::class)->getMock();
        $this->resolver = new BillingSubscriptionResolver($this->subscriptionObjectManager, $this->subscriptionFactory);
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(ResolverInterface::class, $this->resolver);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidArgumentWhileResolve(): void
    {
        $message = $this->getMockBuilder(Message::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $this->resolver->resolve($message);
    }

    public function testValidResolve(): void
    {
        /** @var ApplicationInterface $application */
        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();
        /** @var OAuthShopInterface $shop */
        $shop = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        /** @var SubscriptionInterface $subscription */
        $subscription = $this->getMockBuilder(SubscriptionInterface::class)->getMock();

        $this->subscriptionFactory
            ->expects($this->once())
            ->method('createNewByPayload')
            ->willReturn($subscription);

        $this->subscriptionObjectManager->expects($this->once())
            ->method('persist');
        $this->subscriptionObjectManager->expects($this->once())
            ->method('flush');

        $message = new BillingSubscription($application, $shop);
        $this->resolver->resolve($message);
    }
}
