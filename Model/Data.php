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
    protected $_pos = 0;

    /**
     * @var array
     */
    protected $_data = [];

    /**
     * @var array
     */
    protected $_keys = [];

    /**
     * @var array
     */
    protected $_changedKeys = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->_data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data): void
    {
        $this->_data = $data;
        $this->_keys = array_keys($data);
        $this->_changedKeys = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $data = array();
        foreach($this->_data as $key => $value) {
            if($value instanceof DataInterface) {
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
        $diff = array_intersect_key($this->_data, array_flip($this->_changedKeys));
        foreach($this->_data as $k => $v) {
            if($this->_data[$k] instanceof DataInterface) {
                $partDiff = $this->_data[$k]->getDiffData();
                if(!empty($partDiff)) {
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

        if(!in_array($field, $this->_keys)) {
            $this->_keys[] = $field;
        }
    }

    public function current()
    {
        return $this->_data[$this->_keys[$this->_pos]];
    }

    public function next()
    {
        $this->_pos++;
    }

    public function key()
    {
        return $this->_keys[$this->_pos];
    }

    public function valid()
    {
        if(!isset($this->_keys[$this->_pos])) {
            return false;
        }
        return isset($this->_data[$this->_keys[$this->_pos]]);
    }

    public function rewind()
    {
        $this->_pos = 0;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        if(!isset($this->_data[$name])) {
            return null;
        }

        return $this->_data[$name];
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value): void
    {
        if(!in_array($name, $this->_changedKeys)) {
            $this->_changedKeys[] = $name;
        }

        $this->_data[$name] = $value;
    }
}