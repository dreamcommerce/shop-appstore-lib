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
use DreamCommerce\Component\Common\Util\Sleeper;
use DreamCommerce\Component\ShopAppstore\Api\Http\AwaitShopClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AwaitShopClientTest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    private $psrClient;

    /**
     * @var Sleeper|MockObject
     */
    private $sleeper;

    /**
     * @var AwaitShopClient
     */
    private $shopClient;

    public function setUp(): void
    {
        $this->psrClient = $this->getMockBuilder(ClientInterface::class)->getMock();
        $this->sleeper = $this->getMockBuilder(Sleeper::class)->getMock();
        $this->shopClient = new AwaitShopClient($this->psrClient, null, $this->sleeper);
    }

    public function testRetryLimit(): void
    {
        $this->shopClient->setRetryLimit(15);
        $this->assertEquals(15, $this->shopClient->getRetryLimit());
    }

    public function testSendValidResponse(): void
    {
        /** @var RequestInterface|MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->expects($this->any())
            ->method('withAddedHeader')
            ->willReturn($request);

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->psrClient->expects($this->once())
            ->method('send')
            ->willReturn($response);

        $this->assertEquals($response, $this->shopClient->send($request));
    }

    public function testSendExceedApiCalls(): void
    {
        $retryAfter = 5;

        $this->sleeper->expects($this->once())
            ->method('sleep')
            ->willReturnCallback(function($fRetryAfter) use($retryAfter) {
                $this->assertEquals($retryAfter, $fRetryAfter);
            });

        /** @var RequestInterface|MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->expects($this->any())
            ->method('withAddedHeader')
            ->willReturn($request);

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->expects($this->exactly(2))
            ->method('getStatusCode')
            ->will($this->onConsecutiveCalls(429, 200));

        $response->expects($this->once())
            ->method('getHeaders')
            ->will(
                $this->onConsecutiveCalls([ 'Retry-After' => [$retryAfter] ], [])
            );

        $this->psrClient->expects($this->exactly(2))
            ->method('send')
            ->willReturn($response);

        $this->assertEquals($response, $this->shopClient->send($request));
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException::CODE_EXCEEDED_MAX_API_RETRIES
     */
    public function testSendExceedRetryLimit(): void
    {
        $this->shopClient->setRetryLimit(1);

        /** @var RequestInterface|MockObject $request */
        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->expects($this->any())
            ->method('withAddedHeader')
            ->willReturn($request);

        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(429);

        $response->expects($this->once())
            ->method('getHeaders')
            ->willReturn([ 'Retry-After' => 10 ]);

        $this->psrClient->expects($this->once())
            ->method('send')
            ->willReturn($response);

        $this->assertEquals($response, $this->shopClient->send($request));
    }
}