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
use DreamCommerce\Component\ShopAppstore\Api\Bulk;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Exception\BulkException;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopBulkFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopBulkFactoryInterface;
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
     * @param ShopBulkFactoryInterface|null $shopBulkFactory
     */
    public function __construct(
        ShopClientInterface $shopClient = null,
        AuthenticatorInterface $authenticator = null,
        ShopBulkFactoryInterface $shopBulkFactory = null
    ) {
        $this->shopBulkFactory = $shopBulkFactory;

        parent::__construct($shopClient, $authenticator);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(ShopInterface $shop, Bulk\BulkContainerInterface $container): Bulk\BulkResultInterface
    {
        $rows = [];

        foreach ($container->getOperations() as $key => $operation) {
            $row = [
                'id' => $key,
            ];
            $resourceName = $operation->getResource()->getName();

            $objectName = null;
            if($operation instanceof Bulk\Operation\ObjectOperationInterface) {
                $objectName = $operation->getObjectResource()->getObjectName();
            }

            switch (get_class($operation)) {
                case Bulk\Operation\FetchOperation::class:
                    /** @var Bulk\Operation\FetchOperation $operation */
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $resourceName)->getPath();

                    break;
                case Bulk\Operation\FindOperation::class:
                case Bulk\Operation\FindWithObjectOperation::class:
                    /** @var Bulk\Operation\FindOperation $operation */
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName, $objectName)->getPath();

                    break;
                case Bulk\Operation\FindByOperation::class:
                case Bulk\Operation\FindByWithObjectOperation::class:
                    /** @var Bulk\Operation\FindByOperation $operation */
                    /** @var Criteria $criteria */
                    $criteria = clone $operation->getCriteria();
                    $criteria->rewind();

                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $resourceName, $objectName)->getPath();
                    $row['params'] = $criteria->getQueryParams();

                    break;
                case Bulk\Operation\InsertOperation::class:
                case Bulk\Operation\InsertWithObjectOperation::class:
                    /** @var Bulk\Operation\InsertOperation $operation */
                    $row['method'] = 'POST';
                    $row['path'] = $this->getUri($shop, null, $resourceName, $objectName)->getPath();
                    $row['body'] = $operation->getData();

                    break;
                case Bulk\Operation\UpdateOperation::class:
                case Bulk\Operation\UpdateWithObjectOperation::class:
                    /** @var Bulk\Operation\UpdateOperation $operation */
                    $row['method'] = 'PUT';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName, $objectName)->getPath();
                    $row['body'] = $operation->getData();

                    break;
                case Bulk\Operation\DeleteOperation::class:
                case Bulk\Operation\DeleteWithObjectOperation::class:
                    /** @var Bulk\Operation\DeleteOperation $operation */
                    $row['method'] = 'DELETE';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $resourceName, $objectName)->getPath();

                    break;
                default:
                    throw BulkException::forUnsupportedOperation($operation);
            }

            $rows[] = $row;
        }

        [$request, $response] = $this->perform($shop, 'POST', null, $rows);

        return $this->getShopBulkFactory()->createByApiRequest($this, $container, $shop, $request, $response);
    }

    /**
     * {@inheritdoc}
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
        if ($this->shopBulkFactory !== null) {
            return $this->shopBulkFactory;
        }

        if (self::$globalShopBulkFactory === null) {
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
