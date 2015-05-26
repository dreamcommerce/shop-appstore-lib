<?php

namespace DreamCommerce\Model\Shop;

abstract class OptionChildrenNotSupport extends Option
{
    /**
     * @var int
     */
    protected $changePriceType;

    /**
     * @var float
     */
    protected $changePriceValue;

    /**
     * @var int
     */
    protected $percent;

    /**
     * @return int
     */
    public function getChangePriceType()
    {
        return $this->changePriceType;
    }

    /**
     * @param int $changePriceType
     * @return $this
     */
    public function setChangePriceType($changePriceType)
    {
        $this->changePriceType = $changePriceType;
        return $this;
    }

    /**
     * @return float
     */
    public function getChangePriceValue()
    {
        return $this->changePriceValue;
    }

    /**
     * @param float $changePriceValue
     * @return $this
     */
    public function setChangePriceValue($changePriceValue)
    {
        $this->changePriceValue = $changePriceValue;
        return $this;
    }

    /**
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param int $percent
     * @return $this
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }
}