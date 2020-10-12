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

namespace DreamCommerce\Component\ShopAppstore\Api;

use DreamCommerce\Component\Common\Exception\DefinedException;

class BulkContainer implements BulkContainerInterface
{
    /**
     * @var Bulk\Operation[]
     */
    private $operations = array();

    /**
     * @param Bulk\Operation[] $operations
     */
    public function __construct(array $operations = array())
    {
        $this->operations = $operations;
    }

    /**
     * {@inheritDoc}
     */
    public function addOperation(string $key, Bulk\Operation $operation): void
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
        $this->addOperation($key, new Bulk\Fetch($resource));
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Bulk\Find($resource, $id));
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(string $key, ItemResourceInterface $resource, Criteria $criteria): void
    {
        $this->addOperation($key, new Bulk\FindBy($resource, $criteria));
    }

    /**
     * {@inheritDoc}
     */
    public function insert(string $key, ItemResourceInterface $resource, array $data): void
    {
        $this->addOperation($key, new Bulk\Insert($resource, $data));
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $key, ItemResourceInterface $resource, int $id, array $data): void
    {
        $this->addOperation($key, new Bulk\Update($resource, $id, $data));
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Bulk\Delete($resource, $id));
    }
}