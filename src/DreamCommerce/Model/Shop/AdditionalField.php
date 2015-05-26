<?php

namespace DreamCommerce\Model\Shop;

abstract class AdditionalField implements AdditionalFieldInterface
{
    /**
     * @var int
     */
    protected $fieldId;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $locate;

    /**
     * @var boolean
     */
    protected $req;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var int
     */
    protected $order;

    /**
     * @return int
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * @param int $fieldId
     * @return $this
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getLocate()
    {
        return $this->locate;
    }

    /**
     * @param int $locate
     * @return $this
     */
    public function setLocate($locate)
    {
        $this->locate = $locate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isReq()
    {
        return $this->req;
    }

    /**
     * @param boolean $req
     * @return $this
     */
    public function setReq($req)
    {
        $this->req = $req;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }
}
