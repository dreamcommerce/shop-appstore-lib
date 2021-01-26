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

use DreamCommerce\Component\Common\Exception\DefinedException;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\BaseOperation;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Exception\BulkException;
use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ObjectAwareResourceInterface;
use DreamCommerce\Component\ShopAppstore\Info;

class BulkContainer implements BulkContainerInterface
{
    /**
     * @var int
     */
    private $pos = 0;

    /**
     * @var string[]
     */
    private $keys = [];

    /**
     * @var Operation\BaseOperation[]
     */
    private $list = [];

    /**
     * @param Operation\BaseOperation[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
        $this->keys = array_keys($list);
    }

    /**
     * {@inheritdoc}
     */
    public function addOperation(string $key, Operation\BaseOperation $operation): void
    {
        if (array_key_exists($key, $this->list)) {
            throw DefinedException::forParameter($key);
        }
        if (count($this->list) >= Info::MAX_BULK_API_ITEMS) {
            throw BulkException::forExceedMaxNumberOfCalls($operation);
        }

        $this->list[$key] = $operation;
    }

    /**
     * {@inheritdoc}
     */
    public function setOperation(string $key, Operation\BaseOperation $operation): void
    {
        if (!$this->hasOperation($key) && count($this->list) >= Info::MAX_BULK_API_ITEMS) {
            throw BulkException::forExceedMaxNumberOfCalls($operation);
        }
        $this->list[$key] = $operation;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOperation(string $key): bool
    {
        return isset($this->list[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function getOperation(string $key): ?Operation\BaseOperation
    {
        if (!$this->hasOperation($key)) {
            return null;
        }

        return $this->list[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function getOperations(): array
    {
        return $this->list;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(string $key, DataResourceInterface $resource): void
    {
        $this->addOperation($key, new Operation\FetchOperation($resource));
    }

    /**
     * {@inheritdoc}
     */
    public function find(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Operation\FindOperation($resource, $id));
    }

    /**
     * {@inheritdoc}
     */
    public function findWithObject(string $key, ItemResourceInterface $resource, int $id, ObjectAwareResourceInterface $objectResource): void
    {
        $this->addOperation($key, new Operation\FindWithObjectOperation($resource, $id, $objectResource));
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(string $key, ItemResourceInterface $resource, Criteria $criteria): void
    {
        $this->addOperation($key, new Operation\FindByOperation($resource, $criteria));
    }

    /**
     * {@inheritdoc}
     */
    public function findByWithObject(string $key, ItemResourceInterface $resource, Criteria $criteria, ObjectAwareResourceInterface $objectResource): void
    {
        $this->addOperation($key, new Operation\FindByWithObjectOperation($resource, $criteria, $objectResource));
    }

    /**
     * {@inheritdoc}
     */
    public function insert(string $key, ItemResourceInterface $resource, array $data): void
    {
        $this->addOperation($key, new Operation\InsertOperation($resource, $data));
    }

    /**
     * {@inheritdoc}
     */
    public function insertWithObject(string $key, ItemResourceInterface $resource, array $data, ObjectAwareResourceInterface $objectResource): void
    {
        $this->addOperation($key, new Operation\InsertWithObjectOperation($resource, $data, $objectResource));
    }

    /**
     * {@inheritdoc}
     */
    public function update(string $key, ItemResourceInterface $resource, int $id, array $data): void
    {
        $this->addOperation($key, new Operation\UpdateOperation($resource, $id, $data));
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithObject(string $key, ItemResourceInterface $resource, int $id, array $data, ObjectAwareResourceInterface $objectResource): void
    {
        $this->addOperation($key, new Operation\UpdateWithObjectOperation($resource, $id, $data, $objectResource));
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $key, ItemResourceInterface $resource, int $id): void
    {
        $this->addOperation($key, new Operation\DeleteOperation($resource, $id));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteWithObject(string $key, ItemResourceInterface $resource, int $id, ObjectAwareResourceInterface $objectResource): void
    {
        $this->addOperation($key, new Operation\DeleteWithObjectOperation($resource, $id, $objectResource));
    }

    public function current()
    {
        return $this->list[$this->keys[$this->pos]];
    }

    public function next()
    {
        ++$this->pos;
    }

    public function key()
    {
        return $this->keys[$this->pos];
    }

    public function valid()
    {
        if (!isset($this->keys[$this->pos])) {
            return false;
        }

        return isset($this->list[$this->keys[$this->pos]]);
    }

    public function rewind()
    {
        $this->pos = 0;
    }

    /**
     * @param string $name
     *
     * @return BaseOperation|null
     */
    public function __get(string $name)
    {
        return $this->getOperation($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        $this->setOperation($name, $value);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return $this->hasOperation($name);
    }

    /**
     * @param string $name
     */
    public function __unset(string $name): void
    {
        if (isset($this->list[$name])) {
            unset($this->list[$name]);
        }
    }

    /**
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->hasOperation($offset);
    }

    /**
     * @param string $offset
     *
     * @return Operation\BaseOperation|null
     */
    public function offsetGet($offset)
    {
        return $this->getOperation($offset);
    }

    /**
     * @param string $offset
     * @param Operation\BaseOperation $value
     */
    public function offsetSet($offset, $value)
    {
        $this->setOperation($offset, $value);
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        if (isset($this->list[$offset])) {
            unset($this->list[$offset]);
        }
    }
}
