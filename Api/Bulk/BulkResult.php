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

use DreamCommerce\Component\Common\Exception\InvalidTypeException;

class BulkResult implements BulkResultInterface
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
     * @var Result\BaseResult[]
     */
    private $list = [];

    /**
     * @param Result\BaseResult[] $list
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
        $this->keys = array_keys($list);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(): array
    {
        return $this->list;
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
     * @return mixed|null
     */
    public function __get(string $name)
    {
        if (!isset($this->list[$name])) {
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
        if (!($value instanceof Result\BaseResult)) {
            throw InvalidTypeException::forUnexpectedType(is_object($value) ? get_class($value) : gettype($value), Result\BaseResult::class);
        }

        $this->list[$name] = $value;
    }

    /**
     * @param string $name
     *
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
        return isset($this->list[$offset]);
    }

    /**
     * @param string $offset
     *
     * @return Operation\BaseOperation|null
     */
    public function offsetGet($offset)
    {
        if (!isset($this->list[$offset])) {
            return null;
        }

        return $this->list[$offset];
    }

    /**
     * @param string $offset
     * @param Result\BaseResult $value
     */
    public function offsetSet($offset, $value)
    {
        if (!($value instanceof Result\BaseResult)) {
            throw InvalidTypeException::forUnexpectedType(is_object($value) ? get_class($value) : gettype($value), Result\BaseResult::class);
        }

        $this->list[$offset] = $value;
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
