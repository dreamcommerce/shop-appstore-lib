<?php

namespace DreamCommerce\Model\Shop;

class OptionValue implements OptionValueInterface
{
    /**
     * @var int
     */
    protected $ovalueId;

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
     * @var string
     */
    protected $color;

    /**
     * @var int
     */
    protected $totalProducts;

    /**
     * @var int
     */
    protected $totalStocks;

    /**
     * @var OptionInterface
     */
    protected $option;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getOvalueId()
    {
        return $this->ovalueId;
    }

    /**
     * @param int $ovalueId
     * @return $this
     */
    public function setOvalueId($ovalueId)
    {
        $this->ovalueId = $ovalueId;
        return $this;
    }

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

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalProducts()
    {
        return $this->totalProducts;
    }

    /**
     * @param int $totalProducts
     * @return $this
     */
    public function setTotalProducts($totalProducts)
    {
        $this->totalProducts = $totalProducts;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalStocks()
    {
        return $this->totalStocks;
    }

    /**
     * @param int $totalStocks
     * @return $this
     */
    public function setTotalStocks($totalStocks)
    {
        $this->totalStocks = $totalStocks;
        return $this;
    }

    /**
     * @return OptionInterface
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption(OptionInterface $option)
    {
        $this->option = $option;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(TranslationInterface $translation)
    {
        $this->translations[] = $translation;
        return $this;
    }

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }
}