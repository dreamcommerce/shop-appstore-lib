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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Api\Bulk;
use DreamCommerce\Component\ShopAppstore\Factory\ShopBulkFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopBulkFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

class BulkResource extends Resource implements BulkResourceInterface
{
    use ShopItemTrait;
    use ShopDataTrait;

    /**
     * @var ShopBulkFactoryInterface
     */
    private $shopBulkFactory;

    /**
     * @var ShopBulkFactoryInterface
     */
    private static $globalShopBulkFactory;

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopDataFactoryInterface|null $shopDataFactory
     * @param ShopItemFactoryInterface|null $shopItemFactory
     * @param ShopItemPartListFactoryInterface|null $shopItemPartListFactory
     * @param ShopItemListFactoryInterface|null $shopItemListFactory
     * @param ShopBulkFactoryInterface|null $shopBulkFactory
     */
    public function __construct(ShopClientInterface $shopClient = null,
                                AuthenticatorInterface $authenticator = null,
                                ShopDataFactoryInterface $shopDataFactory = null,
                                ShopItemFactoryInterface $shopItemFactory = null,
                                ShopItemPartListFactoryInterface $shopItemPartListFactory = null,
                                ShopItemListFactoryInterface $shopItemListFactory = null,
                                ShopBulkFactoryInterface $shopBulkFactory = null
    ) {
        $this->shopDataFactory = $shopDataFactory;
        $this->shopItemFactory = $shopItemFactory;
        $this->shopItemPartListFactory = $shopItemPartListFactory;
        $this->shopItemListFactory = $shopItemListFactory;
        $this->shopBulkFactory = $shopBulkFactory;

        parent::__construct($shopClient, $authenticator);
    }

    /**
     * {@inheritDoc}
     */
    public function execute(ShopInterface $shop, Bulk\BulkContainerInterface $container): Bulk\BulkResultInterface
    {
        $rows = array();

        foreach($container->getOperations() as $key => $operation) {
            $row = array(
                'id' => $key
            );
            $resourceName = $operation->getResource()->getName();

            switch(get_class($operation)) {
                case Bulk\Operation\FetchOperation::class:
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $resourceName)->getPath();
                    break;
                case Bulk\Operation\FindOperation::class:
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName)->getPath();
                    break;
                case Bulk\Operation\FindByOperation::class:
                    /** @var Criteria $criteria */
                    $criteria = clone $operation->getCriteria();
                    $criteria->rewind();

                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $resourceName)->getPath();
                    $row['params'] = $criteria->getQueryParams();
                    break;
                case Bulk\Operation\InsertOperation::class:
                    $row['method'] = 'POST';
                    $row['path'] = $this->getUri($shop, null, $resourceName)->getPath();
                    $row['body'] = $operation->getData();
                    break;
                case Bulk\Operation\UpdateOperation::class:
                    $row['method'] = 'PUT';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName)->getPath();
                    $row['body'] = $operation->getData();
                    break;
                case Bulk\Operation\DeleteOperation::class:
                    $row['method'] = 'DELETE';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName)->getPath();
                    break;
                default:
                    throw new \Exception(); // TODO
            }

            $rows[] = $row;
        }

        list($request, $response) = $this->perform($shop, 'POST', null, $rows);

        return $this->getShopBulkFactory()->createByApiRequest($this, $container, $shop, $request, $response);
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'bulk';
    }

    /**
     * @return ShopBulkFactoryInterface
     */
    protected function getShopBulkFactory(): ShopBulkFactoryInterface
    {
        if($this->shopBulkFactory !== null) {
            return $this->shopBulkFactory;
        }

        if(self::$globalShopBulkFactory === null) {
            self::$globalShopBulkFactory = new ShopBulkFactory(
                $this->getGlobalDataFactory(),
                $this->getShopDataFactory(),
                $this->getShopItemFactory(),
                $this->getShopItemPartListFactory()
            );
        }

        return self::$globalShopBulkFactory;
    }
}