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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\BulkContainerInterface;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\BulkResult;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\BulkResultInterface;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\Result;
use DreamCommerce\Component\ShopAppstore\Api\Resource\BulkResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

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
     * @param DataFactoryInterface $dataFactory
     * @param ShopDataFactoryInterface $shopDataFactory
     * @param ShopItemFactoryInterface $shopItemFactory
     * @param ShopItemPartListFactoryInterface $shopItemPartListFactory
     */
    public function __construct(
        DataFactoryInterface $dataFactory,
        ShopDataFactoryInterface $shopDataFactory,
        ShopItemFactoryInterface $shopItemFactory,
        ShopItemPartListFactoryInterface $shopItemPartListFactory
    ) {
        $this->shopDataFactory = $shopDataFactory;
        $this->shopItemFactory = $shopItemFactory;
        $this->shopItemPartListFactory = $shopItemPartListFactory;

        parent::__construct($dataFactory, []);
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new BulkResult();
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiResource(BulkResourceInterface $resource, BulkContainerInterface $container, ShopInterface $shop, array $data): BulkResultInterface
    {
        if (isset($data['errors']) && $data['errors'] && isset($data['message']) && is_array($data['message'])) {
            throw new \Exception(); // TODO
        }

        if (!isset($data['items']) || !is_array($data['items'])) {
            throw new \Exception(); // TODO
        }

        $results = [];
        foreach ($data['items'] as $item) {
            $results[$item['id']] = $this->getResult(
                $container->getOperation($item['id']),
                $shop,
                $item
            );
        }

        return new BulkResult($results);
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiRequest(BulkResourceInterface $resource, BulkContainerInterface $container, ShopInterface $shop, RequestInterface $request, ResponseInterface $response): BulkResultInterface
    {
        return $this->createByApiResource($resource, $container, $shop, $this->handleApiRequest($request, $response));
    }

    /**
     * @param Operation\BaseOperation $operation
     * @param ShopInterface $shop
     * @param array $item
     *
     * @return Result\BaseResult
     */
    protected function getResult(Operation\BaseOperation $operation, ShopInterface $shop, array $item): Result\BaseResult
    {
        $code = (int) $item['code'];

        if ($code === 200) {
            $resource = $operation->getResource();

            switch (get_class($operation)) {
                case Operation\DeleteOperation::class:
                case Operation\DeleteWithObjectOperation::class:
                    return new Result\DeleteResult($operation, $shop);
                case Operation\FetchOperation::class:
                    return new Result\FetchResult($operation, $shop, $this->shopDataFactory->createByApiResource($resource, $shop, (array) $item['body']));
                case Operation\FindByOperation::class:
                case Operation\FindByWithObjectOperation::class:
                    return new Result\FindByResult($operation, $shop, $this->shopItemPartListFactory->createByApiResource($resource, $shop, (array) $item['body']));
                case Operation\FindOperation::class:
                case Operation\FindWithObjectOperation::class:
                    return new Result\FindResult($operation, $shop, $this->shopItemFactory->createByApiResource($resource, $shop, (array) $item['body']));
                case Operation\InsertOperation::class:
                case Operation\InsertWithObjectOperation::class:
                case Operation\InsertWithObjectValueOperation::class:
                case Operation\InsertWithValueOperation::class:
                    $shopItem = $this->shopItemFactory->createByApiResource($resource, $shop, $operation->getData());
                    $shopItem->setExternalId((int) $item['body']);

                    return new Result\InsertResult($operation, $shop, $shopItem);
                case Operation\UpdateOperation::class:
                case Operation\UpdateWithObjectOperation::class:
                    return new Result\UpdateResult($operation, $shop);
                default:
                    throw new RuntimeException('Unsupported type of operation "' . get_class($operation) . '"');
            }
        }

        $error = null;
        $errorDescription = null;

        if (isset($item['body']['error'])) {
            $error = $item['body']['error'];
        }
        if (isset($item['body']['error_description'])) {
            $errorDescription = $item['body']['error_description'];
        }

        if ($code === 404) {
            return new Result\NotFoundResult($operation, $shop, $error, $errorDescription);
        }
        if ($code === 400) {
            return new Result\NotValidResult($operation, $shop, $error, $errorDescription);
        }

        return new Result\ErrorResult($operation, $shop, $code, $error, $errorDescription);
    }
}
