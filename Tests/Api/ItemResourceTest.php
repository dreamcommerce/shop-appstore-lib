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

use DreamCommerce\Component\ShopAppstore\Api\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Tests\Fixtures\Api\Resource\ExampleItemResource;
use PHPUnit\Framework\MockObject\MockObject;

class ItemResourceTest extends ResourceTest
{
    /**
     * @var ExampleItemResource
     */
    private $resource;

    /**
     * @var ShopItemFactoryInterface|MockObject
     */
    private $shopItemFactory;

    /**
     * @var ShopItemPartListFactoryInterface
     */
    private $shopItemPartListFactory;

    /**
     * @var ShopItemListFactoryInterface
     */
    private $shopItemListFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopItemFactory = $this->getMockBuilder(ShopItemFactoryInterface::class)->getMock();
        $this->shopItemPartListFactory = $this->getMockBuilder(ShopItemPartListFactoryInterface::class)->getMock();
        $this->shopItemListFactory = $this->getMockBuilder(ShopItemListFactoryInterface::class)->getMock();

        $this->resource = new ExampleItemResource(
            $this->shopClient, $this->authenticator, $this->shopItemFactory,
            $this->shopItemPartListFactory, $this->shopItemListFactory
        );
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(ItemResourceInterface::class, $this->resource);
    }


}