<?php

namespace DreamCommerce\Model\Shop;

class AttributeSelect extends Attribute
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}