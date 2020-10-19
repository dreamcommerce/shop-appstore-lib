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

use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;

interface BulkContainerInterface
{
    /**
     * @param string $key
     * @param Operation\BaseOperation $operation
     */
    public function addOperation(string $key, Operation\BaseOperation $operation): void;

    /**
     * @return Operation\BaseOperation[]
     */
    public function getOperations(): array;

    /**
     * @param string $key
     * @param DataResourceInterface $resource
     */
    public function fetch(string $key, DataResourceInterface $resource): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param int $id
     */
    public function find(string $key, ItemResourceInterface $resource, int $id): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param Criteria $criteria
     */
    public function findBy(string $key, ItemResourceInterface $resource, Criteria $criteria): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param array $data
     */
    public function insert(string $key, ItemResourceInterface $resource, array $data): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param int $id
     * @param array $data
     */
    public function update(string $key, ItemResourceInterface $resource, int $id, array $data): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param int $id
     */
    public function delete(string $key, ItemResourceInterface $resource, int $id): void;
}