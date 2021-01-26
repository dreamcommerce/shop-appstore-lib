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

namespace DreamCommerce\Component\ShopAppstore\Api\Bulk;

use ArrayAccess;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ObjectAwareResourceInterface;
use Iterator;

interface BulkContainerInterface extends ArrayAccess, Iterator
{
    /**
     * @param string $key
     * @param Operation\BaseOperation $operation
     */
    public function addOperation(string $key, Operation\BaseOperation $operation): void;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasOperation(string $key): bool;

    /**
     * @param string $key
     * @param Operation\BaseOperation $operation
     */
    public function setOperation(string $key, Operation\BaseOperation $operation): void;

    /**
     * @param string $key
     *
     * @return Operation\BaseOperation|null
     */
    public function getOperation(string $key): ?Operation\BaseOperation;

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
     * @param int $id
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function findWithObject(string $key, ItemResourceInterface $resource, int $id, ObjectAwareResourceInterface $objectResource): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param Criteria $criteria
     */
    public function findBy(string $key, ItemResourceInterface $resource, Criteria $criteria): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param Criteria $criteria
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function findByWithObject(string $key, ItemResourceInterface $resource, Criteria $criteria, ObjectAwareResourceInterface $objectResource): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param array $data
     */
    public function insert(string $key, ItemResourceInterface $resource, array $data): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param array $data
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function insertWithObject(string $key, ItemResourceInterface $resource, array $data, ObjectAwareResourceInterface $objectResource): void;

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
     * @param array $data
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function updateWithObject(string $key, ItemResourceInterface $resource, int $id, array $data, ObjectAwareResourceInterface $objectResource): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param int $id
     */
    public function delete(string $key, ItemResourceInterface $resource, int $id): void;

    /**
     * @param string $key
     * @param ItemResourceInterface $resource
     * @param int $id
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function deleteWithObject(string $key, ItemResourceInterface $resource, int $id, ObjectAwareResourceInterface $objectResource): void;
}
