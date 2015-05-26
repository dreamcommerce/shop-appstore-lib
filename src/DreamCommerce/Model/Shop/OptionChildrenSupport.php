<?php

namespace DreamCommerce\Model\Shop;

abstract class OptionChildrenSupport extends Option
{
    /**
     * @var boolean
     */
    protected $stock;

    /**
     * @var boolean
     */
    protected $filters;

    /**
     * @return boolean
     */
    public function isStock()
    {
        return $this->stock;
    }

    /**
     * @param boolean $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFilters()
    {
        return $this->filters;
    }

    /**
     * @param boolean $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }
}