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

namespace DreamCommerce\Component\ShopAppstore\Tests\Api;

use DreamCommerce\Component\Common\Http\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

abstract class ResourceTest extends TestCase
{
    /**
     * @var ShopClientInterface|MockObject
     */
    protected $shopClient;

    /**
     * @var AuthenticatorInterface|MockObject
     */
    protected $authenticator;

    public function setUp(): void
    {
        $this->shopClient = $this->getMockBuilder(ShopClientInterface::class)->getMock();
        $this->authenticator = $this->getMockBuilder(AuthenticatorInterface::class)->getMock();

        parent::setUp();
    }

    protected function getShop(bool $isAuthenticated = true)
    {
        $token = $this->getMockBuilder(TokenInterface::class)->getMock();
        $token->expects($this->once())
            ->method('getAccessToken');

        $uri = $this->getMockBuilder(UriInterface::class)->getMock();
        $uri->method('withPath')
            ->willReturn($uri);

        /** @var ShopInterface|MockObject $shop */
        $shop = $this->getMockBuilder(ShopInterface::class)->getMock();
        $shop->expects($this->once())
            ->method('getToken')
            ->willReturn($token);
        $shop->expects($this->once())
            ->method('getUri')
            ->willReturn($uri);
        $shop->expects($this->once())
            ->method('isAuthenticated')
            ->willReturn($isAuthenticated);

        if ($isAuthenticated) {
            $test = $this->never();
        } else {
            $test = $this->once();
        }

        $this->authenticator->expects($test)
            ->method('authenticate');

        return $shop;
    }

    protected function prepareRequest()
    {
        $httpClient = $this->getMockBuilder(ClientInterface::class)->getMock();
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();

        $this->shopClient->expects($this->once())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $httpClient->expects($this->once())
            ->method('createRequest')
            ->willReturn($request);

        $this->shopClient->expects($this->once())
            ->method('send')
            ->willReturn($response);

        return [$request, $response];
    }
}
