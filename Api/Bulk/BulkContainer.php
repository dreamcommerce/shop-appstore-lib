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
use DreamCommerce\Component\Common\Exception\InvalidTypeException;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;

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
    public function __construct(array $list = array())
    {
        $this->list = $list;
        $this->keys = array_keys($list);
    }

    /**
     * {@inheritDoc}
     */
    public function addOperation(string $key, Operation\BaseOperation $operation): void
    {
        if(array_key_exists($key, $this->list)) {
            throw DefinedException::forParameter($key);
        }
        $this->list[$key] = $operation;
    }

    /**
     * {@inheritDoc}
     */
    public function hasOperation(string $key): bool
    {
        return isset($this->list[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function getOperation(string $key): ?Operation\BaseOperation
    {
        if(!$this->hasOperation($key)) {
            return null;
        }

        return $this->list[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function getOperations(): array
    {
        return $this->list;
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

    public function current()
    {
        return $this->list[$this->keys[$this->pos]];
    }

    public function next()
    {
        $this->pos++;
    }

    public function key()
    {
        return $this->keys[$this->pos];
    }

    public function valid()
    {
        if(!isset($this->keys[$this->pos])) {
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
     * @return mixed|null
     */
    public function __get(string $name)
    {
        if(!isset($this->list[$name])) {
            return null;
        }

        return $this->list[$name];
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if(!($value instanceof Operation\BaseOperation)) {
            throw InvalidTypeException::forUnexpectedType(is_object($value) ? get_class($value) : gettype($value), Operation\BaseOperation::class);
        }

        $this->list[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->list[$name]);
    }

    /**
     * @param string $name
     */
    public function __unset(string $name): void
    {
        if(isset($this->list[$name])) {
            unset($this->list[$name]);
        }
    }

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->list[$offset]);
    }

    /**
     * @param string $offset
     * @return Operation\BaseOperation|null
     */
    public function offsetGet($offset)
    {
        if(!isset($this->list[$offset])) {
            return null;
        }

        return $this->list[$offset];
    }

    /**
     * @param string $offset
     * @param Operation\BaseOperation $value
     */
    public function offsetSet($offset, $value)
    {
        if(!($value instanceof Operation\BaseOperation)) {
            throw InvalidTypeException::forUnexpectedType(is_object($value) ? get_class($value) : gettype($value), Operation\BaseOperation::class);
        }

        $this->list[$offset] = $value;
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        if(isset($this->list[$offset])) {
            unset($this->list[$offset]);
        }
    }
}