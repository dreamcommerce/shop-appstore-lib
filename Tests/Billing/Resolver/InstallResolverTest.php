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

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Install;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\InstallResolver;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\ResolverInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\ShopTransitions;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SM\Factory\FactoryInterface;
use SM\StateMachine\StateMachineInterface;

class InstallResolverTest extends TestCase
{
    /**
     * @var FactoryInterface|MockObject
     */
    protected $shopStateMachineFactory;

    /**
     * @var AuthenticatorInterface|MockObject
     */
    protected $authenticator;

    /**
     * @var InstallResolver
     */
    protected $resolver;

    public function setUp(): void
    {
        $this->shopStateMachineFactory = $this->getMockBuilder(FactoryInterface::class)->getMock();
        $this->authenticator = $this->getMockBuilder(AuthenticatorInterface::class)->getMock();
        $this->resolver = new InstallResolver($this->shopStateMachineFactory,$this->authenticator);
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
     * @dataProvider versionMessages
     *
     * @param Install $message
     */
    public function testChangeVersionWhileResolving(Install $message): void
    {
        $lastVersion = $message->getShop()->getVersion();

        $this->shopStateMachineFactory
            ->expects($this->once())
            ->method('get')
            ->will($this->returnCallback(function () {
                $stateMachine = $this->getMockBuilder(StateMachineInterface::class)->getMock();
                $stateMachine->expects($this->once())->method('apply');

                return $stateMachine;
            }));

        $this->authenticator
            ->expects($this->once())
            ->method('authenticate');

        $this->resolver->resolve($message);
        $this->assertTrue($message->getShop()->getVersion() >= $lastVersion);
    }

    /**
     * @dataProvider stateMessages
     *
     * @param Install $message
     * @param string $transition
     */
    public function testChangeStateWhileResolving(Install $message, string $transition): void
    {
        $this->shopStateMachineFactory
            ->expects($this->once())
            ->method('get')
            ->will($this->returnCallback(function () use ($transition) {
                $stateMachine = $this->getMockBuilder(StateMachineInterface::class)->getMock();
                $stateMachine
                    ->expects($this->once())
                    ->method('apply')
                    ->will($this->returnCallback(function ($fTransition) use ($transition) {
                        $this->assertEquals($transition, $fTransition);
                    }));

                return $stateMachine;
            }));

        $this->authenticator
            ->expects($this->once())
            ->method('authenticate');

        $this->resolver->resolve($message);
    }

    /* --------------------------------------------------------------------- */

    public function stateMessages(): array
    {
        /** @var ApplicationInterface $application */
        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();

        $messages = [];
        $map = [
            OAuthShopInterface::STATE_NEW => ShopTransitions::TRANSITION_ENQUEUE_DOWNLOAD_TOKENS,
            OAuthShopInterface::STATE_PREFETCH_TOKENS => ShopTransitions::TRANSITION_RETRY_DOWNLOAD_TOKENS,
            OAuthShopInterface::STATE_REJECTED_AUTH_CODE => ShopTransitions::TRANSITION_REFRESH_AUTH_CODE,
            OAuthShopInterface::STATE_UNINSTALLED => ShopTransitions::TRANSITION_REINSTALL,
        ];

        foreach ($map as $state => $transition) {
            $shop = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
            $shop->method('getState')
                ->willReturn($state);

            $messages[] = [new Install($application, $shop, ['application_version' => time()]), $transition];
        }

        return $messages;
    }

    public function versionMessages(): array
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

        foreach ([$shop1, $shop2, $shop3] as $shop) {
            $shop->expects($this->once())
                ->method('getState')
                ->willReturn(OAuthShopInterface::STATE_NEW)
            ;
        }

        return [
            [new Install($application, $shop1, ['application_version' => $currentVersion - 10])],
            [new Install($application, $shop2, ['application_version' => $currentVersion])],
            [new Install($application, $shop3, ['application_version' => $currentVersion + 10])],
        ];
    }
}
