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

namespace DreamCommerce\Component\ShopAppstore\Model;

class Data implements DataInterface
{
    /**
     * @var int
     */
    protected $pos = 0;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $keys = [];

    /**
     * @var array
     */
    protected $changedKeys = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data): void
    {
        $this->data = $data;
        $this->keys = array_keys($data);
        $this->changedKeys = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $data = [];
        foreach ($this->data as $key => $value) {
            if ($value instanceof DataInterface) {
                $value = $value->getData();
            }
            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getDiffData(): array
    {
        $diff = array_intersect_key($this->data, array_flip($this->changedKeys));
        foreach ($this->data as $k => $v) {
            if ($this->data[$k] instanceof DataInterface) {
                $partDiff = $this->data[$k]->getDiffData();
                if (!empty($partDiff)) {
                    $diff[$k] = $partDiff;
                }
            }
        }

        return $diff;
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldValue(string $field)
    {
        return $this->$field;
    }

    /**
     * {@inheritdoc}
     */
    public function setFieldValue(string $field, $value): void
    {
        $this->$field = $value;

        if (!in_array($field, $this->keys)) {
            $this->keys[] = $field;
        }
    }

    public function current()
    {
        return $this->data[$this->keys[$this->pos]];
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

        return isset($this->data[$this->keys[$this->pos]]);
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
        if (!isset($this->data[$name])) {
            return null;
        }

        return $this->data[$name];
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if (!in_array($name, $this->changedKeys)) {
            $this->changedKeys[] = $name;
        }

        $this->data[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @param string $name
     */
    public function __unset(string $name): void
    {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);
        }
    }
}
