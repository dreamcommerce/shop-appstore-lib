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

use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use DreamCommerce\Component\ShopAppstore\Tests\Fixtures\Api\Resource\ExampleDataResource;
use PHPUnit\Framework\MockObject\MockObject;

class DataResourceTest extends ResourceTest
{
    /**
     * @var ExampleDataResource
     */
    private $resource;

    /**
     * @var ShopDataFactoryInterface|MockObject
     */
    private $shopDataFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopDataFactory = $this->getMockBuilder(ShopDataFactoryInterface::class)->getMock();
        $this->resource = new ExampleDataResource($this->shopClient, $this->authenticator, $this->shopDataFactory);
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(DataResourceInterface::class, $this->resource);
    }

    public function testFetchWithAuthentication(): void
    {
        $shop = $this->getShop(false);
        $this->fetchData($shop);
    }

    public function testFetchWithoutAuthentication(): void
    {
        $shop = $this->getShop(true);
        $this->fetchData($shop);
    }

    private function fetchData($shop)
    {
        [$request, $response] = $this->prepareRequest();

        $this->shopDataFactory->expects($this->once())
            ->method('createByApiRequest')
            ->willReturnCallback(function ($fResource, $fShop, $fRequest, $fResponse) use ($shop, $request, $response) {
                $this->assertEquals($shop, $fShop);
                $this->assertEquals($request, $fRequest);
                $this->assertEquals($response, $fResponse);
                $this->assertEquals($this->resource, $fResource);

                return $this->getMockBuilder(ShopDataInterface::class)->getMock();
            });

        $this->resource->fetch($shop);
    }
}
