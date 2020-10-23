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

namespace DreamCommerce\Component\ShopAppstore\Tests\Api\Http;

use DreamCommerce\Component\Common\Http\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClient;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class ShopClientTest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    private $psrClient;

    /**
     * @var ShopClient
     */
    private $shopClient;

    public function setUp(): void
    {
        $this->psrClient = $this->getMockBuilder(ClientInterface::class)->getMock();
        $this->shopClient = new ShopClient($this->psrClient);
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(ShopClientInterface::class, $this->shopClient);
    }

    public function testSendValidResponse(): void
    {
        $this->setResponseCode(200);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\ValidationException
     */
    public function testSendInvalidData(): void
    {
        $this->setResponseCode(400);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\PermissionsException
     */
    public function testSendInsufficientPermission(): void
    {
        $this->setResponseCode(401);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\NotFoundException
     */
    public function testSendNotFound(): void
    {
        $this->setResponseCode(404);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\MethodUnsupportedException
     */
    public function testSendUnsupportedMethod(): void
    {
        $this->setResponseCode(405);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\ObjectLockedException
     */
    public function testSendObjectLocked(): void
    {
        $this->setResponseCode(409);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException
     */
    public function testSendRetryAfter(): void
    {
        $this->setResponseCode(429);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException::BROKEN_CONNECTION
     */
    public function testSendUnexpectedException(): void
    {
        $this->psrClient->expects($this->once())
            ->method('send')
            ->willThrowException(new RuntimeException());

        /** @var RequestInterface|MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->expects($this->any())
            ->method('withAddedHeader')
            ->willReturn($request);

        $this->shopClient->send($request);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException::INVALID_RESPONSE_CODE
     */
    public function testSendInvalidResponseCode(): void
    {
        $this->setResponseCode(500);
    }

    private function setResponseCode(int $code): void
    {
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($code);

        /** @var RequestInterface|MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->expects($this->any())
            ->method('withAddedHeader')
            ->willReturn($request);

        $this->psrClient->expects($this->once())
            ->method('send')
            ->willReturn($response);

        $this->assertEquals($response, $this->shopClient->send($request));
    }
}
