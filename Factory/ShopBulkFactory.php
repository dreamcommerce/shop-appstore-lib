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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk\BulkResult;
use DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk\BulkResultInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\BulkResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ShopBulkFactory extends AbstractFactory implements ShopBulkFactoryInterface
{
    /**
     * @var ShopDataFactoryInterface
     */
    private $shopDataFactory;

    /**
     * @var ShopItemFactoryInterface
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

    /**
     * @param DataFactoryInterface $dataFactory
     * @param ShopDataFactoryInterface $shopDataFactory
     * @param ShopItemFactoryInterface $shopItemFactory
     * @param ShopItemPartListFactoryInterface $shopItemPartListFactory
     * @param ShopItemListFactoryInterface $shopItemListFactory
     */
    public function __construct(DataFactoryInterface $dataFactory,
                                ShopDataFactoryInterface $shopDataFactory,
                                ShopItemFactoryInterface $shopItemFactory,
                                ShopItemPartListFactoryInterface $shopItemPartListFactory,
                                ShopItemListFactoryInterface $shopItemListFactory
    ) {
        $this->shopDataFactory = $shopDataFactory;
        $this->shopItemFactory = $shopItemFactory;
        $this->shopItemPartListFactory = $shopItemPartListFactory;
        $this->shopItemListFactory = $shopItemListFactory;

        parent::__construct($dataFactory, array());
    }

    /**
     * {@inheritDoc}
     */
    public function createNew()
    {
        return new BulkResult();
    }

    /**
     * {@inheritDoc}
     */
    public function createByApiResource(BulkResourceInterface $resource, ShopInterface $shop, array $data): BulkResultInterface
    {
        // TODO: Implement createByApiResource() method.
    }

    /**
     * {@inheritDoc}
     */
    public function createByApiRequest(BulkResourceInterface $resource, ShopInterface $shop, RequestInterface $request, ResponseInterface $response): BulkResultInterface
    {
        return $this->createByApiResource($resource, $shop, $this->handleApiRequest($request, $response));
    }

}