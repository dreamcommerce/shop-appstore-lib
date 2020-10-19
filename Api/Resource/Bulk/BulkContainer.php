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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk;

use DreamCommerce\Component\Common\Exception\DefinedException;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;

class BulkContainer implements BulkContainerInterface
{
    /**
     * @var Operation\BaseOperation[]
     */
    private $operations = array();

    /**
     * @param Operation\BaseOperation[] $operations
     */
    public function __construct(array $operations = array())
    {
        $this->operations = $operations;
    }

    /**
     * {@inheritDoc}
     */
    public function addOperation(string $key, Operation\BaseOperation $operation): void
    {
        if(array_key_exists($key, $this->operations)) {
            throw DefinedException::forParameter($key);
        }
        $this->operations[$key] = $operation;
    }

    /**
     * {@inheritDoc}
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(string $key, DataResourceInterface $resource): void
    {
        $this->addOperation($key, new Operation\FetchOperation($resource));
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Operation\FindOperation($resource, $id));
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(string $key, ItemResourceInterface $resource, Criteria $criteria): void
    {
        $this->addOperation($key, new Operation\FindByOperation($resource, $criteria));
    }

    /**
     * {@inheritDoc}
     */
    public function insert(string $key, ItemResourceInterface $resource, array $data): void
    {
        $this->addOperation($key, new Operation\InsertOperation($resource, $data));
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $key, ItemResourceInterface $resource, int $id, array $data): void
    {
        $this->addOperation($key, new Operation\UpdateOperation($resource, $id, $data));
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Operation\DeleteOperation($resource, $id));
    }
}