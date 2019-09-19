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

namespace DreamCommerce\Component\ShopAppstore\Tests\Billing;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\Common\Factory\UriFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Dispatcher;
use DreamCommerce\Component\ShopAppstore\Billing\DispatcherInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\ResolverInterface;
use DreamCommerce\Component\ShopAppstore\Factory\OAuthShopFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Info;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Repository\ShopRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Sylius\Component\Registry\NonExistingServiceException;
use Sylius\Component\Registry\ServiceRegistryInterface;

class DispatcherTest extends TestCase
{
    private const APPSTORE_SECRET = 'APPSTORE_SECRET';
    private const APPLICATION_CODE = 'APPLICATION_CODE';

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var ResolverInterface[]|MockObject[]
     */
    private $resolvers = [];

    /**
     * @var ServiceRegistryInterface|MockObject
     */
    private $applicationRegistry;

    /**
     * @var ShopRepositoryInterface|MockObject
     */
    private $shopRepository;

    /**
     * @var OAuthShopFactoryInterface|MockObject
     */
    private $shopFactory;

    /**
     * @var ObjectManager|MockObject
     */
    private $shopObjectManager;

    /**
     * @var UriFactoryInterface|MockObject
     */
    private $uriFactory;

    /**
     * @var ServiceRegistryInterface|MockObject
     */
    private $resolverRegistry;

    public function setUp(): void
    {
        $this->applicationRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();
        $this->shopRepository = $this->getMockBuilder(ShopRepositoryInterface::class)->getMock();
        $this->shopFactory = $this->getMockBuilder(OAuthShopFactoryInterface::class)->getMock();
        $this->shopObjectManager = $this->getMockBuilder(ObjectManager::class)->getMock();
        $this->uriFactory = $this->getMockBuilder(UriFactoryInterface::class)->getMock();
        $this->resolverRegistry = $this->getMockBuilder(ServiceRegistryInterface::class)->getMock();

        $this->dispatcher = new Dispatcher(
            $this->applicationRegistry,
            $this->shopRepository,
            $this->shopFactory,
            $this->shopObjectManager,
            $this->uriFactory,
            $this->resolverRegistry
        );
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(DispatcherInterface::class, $this->dispatcher);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException::CODE_INVALID_REQUEST_METHOD
     */
    public function testInvalidRequestMethodWhileDispatching(): void
    {
        $serverRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
        $serverRequest->expects($this->once())
            ->method('getMethod')
            ->willReturn('GET');

        $this->dispatcher->dispatch($serverRequest);
    }

    /**
     * @dataProvider invalidRequestParams
     * @expectedException \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException::CODE_UNFULFILLED_REQUIREMENTS
     *
     * @param array $params
     */
    public function testUnfulfilledRequirementsWhileDispatching(array $params = []): void
    {
        $serverRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
        $serverRequest->expects($this->once())
            ->method('getMethod')
            ->willReturn('POST');
        $serverRequest->expects($this->once())
            ->method('getParsedBody')
            ->willReturn($params);

        $this->dispatcher->dispatch($serverRequest);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException::CODE_NOT_EXIST_APPLICATION
     */
    public function testNotExistApplicationWhileDispatching(): void
    {
        $params = $this->getValidRequestParams(DispatcherInterface::ACTION_UNINSTALL);

        $serverRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
        $serverRequest->expects($this->once())
            ->method('getMethod')
            ->willReturn('POST');
        $serverRequest->expects($this->once())
            ->method('getParsedBody')
            ->willReturn($params);

        $this->applicationRegistry->expects($this->once())
            ->method('get')
            ->willThrowException(new NonExistingServiceException('', '', []));

        $this->dispatcher->dispatch($serverRequest);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException::CODE_INVALID_PAYLOAD_HASH
     */
    public function testInvalidHashWhileDispatching(): void
    {
        $params = $this->getValidRequestParams(DispatcherInterface::ACTION_UNINSTALL);
        $params['hash'] = '#';

        $serverRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();
        $serverRequest->expects($this->once())
            ->method('getMethod')
            ->willReturn('POST');
        $serverRequest->expects($this->once())
            ->method('getParsedBody')
            ->willReturn($params);

        $this->applicationRegistry->expects($this->once())
            ->method('get')
            ->willReturn(
                $this->getMockBuilder(ApplicationInterface::class)->getMock()
            );

        $this->dispatcher->dispatch($serverRequest);
    }

    /**
     * @dataProvider validServerRequests
     *
     * @param ServerRequestInterface $serverRequest
     * @param string $action
     */
    public function testValidDispatch(ServerRequestInterface $serverRequest, string $action): void
    {
        $this->registerResolvers();

        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();
        $application->expects($this->once())
            ->method('getAppstoreSecret')
            ->willReturn(self::APPSTORE_SECRET)
        ;

        $uri = $this->getMockBuilder(UriInterface::class)->getMock();

        $this->uriFactory->expects($this->once())
            ->method('createNewByUriString')
            ->will($this->returnCallback(function ($uriString) use ($serverRequest, $uri) {
                $params = $serverRequest->getParsedBody();
                $this->assertEquals($params['shop_url'], $uriString);

                return $uri;
            }));

        $this->applicationRegistry->expects($this->once())
            ->method('get')
            ->willReturn($application)
        ;

        $this->shopRepository->expects($this->once())
            ->method('findOneByNameAndApplication')
            ->willReturn(null)
        ;

        $shop = $this->getMockBuilder(OAuthShopInterface::class)->getMock();

        $this->shopFactory->expects($this->once())
            ->method('createNewByApplicationAndUri')
            ->will($this->returnCallback(function ($fApplication, $fUri) use ($application, $uri, $shop) {
                $this->assertEquals($application, $fApplication);
                $this->assertEquals($uri, $fUri);

                return $shop;
            }));

        $this->resolvers[$action]->expects($this->once())
            ->method('resolve')
            ->will($this->returnCallback(function ($payload) use ($action) {
                /** @var Message $payload */
                $this->assertInstanceOf(DispatcherInterface::ACTION_PAYLOAD_MAP[$action], $payload);

                $timestamp = $payload->getTimestamp();
                $this->assertInstanceOf(DateTime::class, $timestamp);
                $this->assertEquals($timestamp->getTimezone()->getName(), Info::TIMEZONE);

                $this->assertInstanceOf(OAuthShopInterface::class, $payload->getShop());
                $this->assertInstanceOf(ApplicationInterface::class, $payload->getApplication());

                if ($action === DispatcherInterface::ACTION_BILLING_SUBSCRIPTION) {
                    $subscriptionTime = $payload->getSubscriptionEndTime();
                    $this->assertInstanceOf(DateTime::class, $subscriptionTime);
                    $this->assertEquals($subscriptionTime->getTimezone()->getName(), Info::TIMEZONE);
                } elseif (in_array($action, [DispatcherInterface::ACTION_INSTALL, DispatcherInterface::ACTION_UPGRADE])) {
                    $this->assertInternalType('int', $payload->getApplicationVersion());
                    if ($action === DispatcherInterface::ACTION_INSTALL) {
                        $this->assertNotNull($payload->getAuthCode());
                    }
                }
            }));

        $this->shopObjectManager->expects($this->once())
            ->method('persist');
        $this->shopObjectManager->expects($this->once())
            ->method('flush');

        $this->dispatcher->dispatch($serverRequest);
    }

    public function testUpdateShopUrlWhileDispatch(): void
    {
        $action = DispatcherInterface::ACTION_UNINSTALL;
        $serverRequest = $this->getValidServerRequest($action);

        $resolver = $this->getMockBuilder(ResolverInterface::class)->getMock();
        $this->resolverRegistry->method('get')
            ->willReturn($resolver);

        $uri = $this->getMockBuilder(UriInterface::class)->getMock();

        $this->uriFactory->expects($this->once())
            ->method('createNewByUriString')
            ->will($this->returnCallback(function ($uriString) use ($serverRequest, $uri) {
                $params = $serverRequest->getParsedBody();
                $this->assertEquals($params['shop_url'], $uriString);

                return $uri;
            }));

        $shop = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        $shop->expects($this->once())
            ->method('setUri')
            ->will($this->returnCallback(function ($fUri) use ($uri) {
                /** @var UriInterface $fUri */
                $this->assertInstanceOf(UriInterface::class, $fUri);
                $this->assertEquals($uri, $fUri);
            }));

        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();
        $application->expects($this->once())
            ->method('getAppstoreSecret')
            ->willReturn(self::APPSTORE_SECRET);

        $this->applicationRegistry->expects($this->once())
            ->method('get')
            ->willReturn($application)
        ;

        $this->shopRepository->expects($this->once())
            ->method('findOneByNameAndApplication')
            ->willReturn($shop)
        ;

        $this->shopObjectManager->expects($this->once())
            ->method('persist');
        $this->shopObjectManager->expects($this->once())
            ->method('flush');

        $this->dispatcher->dispatch($serverRequest);
    }

    /* --------------------------------------------------------------------- */

    public function validServerRequests(): array
    {
        $serverRequests = [];
        foreach (array_keys(DispatcherInterface::ACTION_PAYLOAD_MAP) as $action) {
            $serverRequests[] = [$this->getValidServerRequest($action), $action];
        }

        return $serverRequests;
    }

    public function invalidRequestParams(): array
    {
        $validParams = [
            'action' => DispatcherInterface::ACTION_UNINSTALL,
            'shop' => '12345',
            'shop_url' => 'http://dreamcommerce.com',
            'hash' => '#',
            'timestamp' => time(),
            'application_code' => md5((string) time()),
        ];

        $params = [];

        // 1. parameters have not been sent

        $params[] = [[]];

        // 2. parameters are empty

        $params[] = [array_fill_keys(array_keys($validParams), '')];

        // 3. parameter "subscription_end_time" has not been sent for action "billing_subscription"

        $invalidParams = $validParams;
        $invalidParams['action'] = DispatcherInterface::ACTION_BILLING_SUBSCRIPTION;

        $params[] = [$invalidParams];

        // 4. parameter "application_version" has not been sent for action "install" and "upgrade"

        $invalidParams = $validParams;
        $invalidParams['action'] = DispatcherInterface::ACTION_INSTALL;

        $params[] = [$invalidParams];

        $invalidParams = $validParams;
        $invalidParams['action'] = DispatcherInterface::ACTION_UPGRADE;

        $params[] = [$invalidParams];

        return $params;
    }

    /* --------------------------------------------------------------------- */

    /**
     * @param string $action
     *
     * @return MockObject|ServerRequestInterface
     */
    private function getValidServerRequest(string $action): MockObject
    {
        $serverRequest = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
        $serverRequest->expects($this->once())
            ->method('getMethod')
            ->willReturn('POST');
        $serverRequest->expects($this->any())
            ->method('getParsedBody')
            ->willReturn(
                $this->getValidRequestParams($action)
            );

        return $serverRequest;
    }

    private function getValidRequestParams(string $action): array
    {
        $dt = new DateTime();

        $params = [
            'action' => $action,
            'shop' => md5(uniqid((string) rand(), true)),
            'shop_url' => 'http://dreamcommerce.com',
            'timestamp' => $dt->format('Y-m-d H:i:s'),
            'application_code' => self::APPLICATION_CODE,
        ];

        switch ($action) {
            case DispatcherInterface::ACTION_INSTALL:
                $params['auth_code'] = 'AUTH_CODE';
                $params['application_version'] = (string) time();

                break;
            case DispatcherInterface::ACTION_UPGRADE:
                $params['application_version'] = (string) time();

                break;
            case DispatcherInterface::ACTION_BILLING_SUBSCRIPTION:
                $dt->add(new \DateInterval('P10D'));
                $params['subscription_end_time'] = $dt->format('Y-m-d H:i:s');

                break;
        }

        ksort($params);

        $processedPayload = '';
        foreach ($params as $k => $v) {
            $processedPayload .= '&' . $k . '=' . $v;
        }
        $processedPayload = substr($processedPayload, 1);
        $params['hash'] = hash_hmac('sha512', $processedPayload, self::APPSTORE_SECRET);

        return $params;
    }

    private function registerResolvers(): void
    {
        $map = [];
        foreach (array_keys(DispatcherInterface::ACTION_PAYLOAD_MAP) as $action) {
            $this->resolvers[$action] = $this->getMockBuilder(ResolverInterface::class)->getMock();
            $map[] = [$action, $this->resolvers[$action]];
        }

        $this->resolverRegistry->method('get')
            ->will($this->returnValueMap($map))
        ;
    }
}
