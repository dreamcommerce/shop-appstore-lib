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

use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Upgrade;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\ResolverInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\UpgradeResolver;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use PHPUnit\Framework\TestCase;

class UpgradeResolverTest extends TestCase
{
    /**
     * @var UpgradeResolver
     */
    protected $resolver;

    public function setUp(): void
    {
        $this->resolver = new UpgradeResolver();
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

    /**
     * @dataProvider validMessages
     *
     * @param Upgrade $message
     */
    public function testValidResolve(Upgrade $message): void
    {
        $lastVersion = $message->getShop()->getVersion();

        $this->resolver->resolve($message);
        $this->assertTrue($message->getShop()->getVersion() >= $lastVersion);
    }

    public function validMessages(): array
    {
        /** @var ApplicationInterface $application */
        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();
        $currentVersion = time();

        $shop1 = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        $shop1->expects($this->any())
            ->method('getVersion')
            ->willReturn($currentVersion)
        ;
        $shop1->expects($this->never())
            ->method('setVersion')
        ;

        $shop2 = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        $shop2->expects($this->any())
            ->method('getVersion')
            ->willReturn($currentVersion)
        ;
        $shop2->expects($this->never())
            ->method('setVersion')
        ;

        $shop3 = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        $shop3->expects($this->any())
            ->method('getVersion')
            ->willReturn($currentVersion)
        ;
        $shop3->expects($this->once())
            ->method('setVersion')
        ;

        return [
            [new Upgrade($application, $shop1, ['application_version' => $currentVersion - 10])],
            [new Upgrade($application, $shop2, ['application_version' => $currentVersion])],
            [new Upgrade($application, $shop3, ['application_version' => $currentVersion + 10])],
        ];
    }
}
