<?php

namespace DreamCommerce\Model\Shop;

class UnitTranslation implements UnitTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var UnitInterface
     */
    protected $unit;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @return int
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return UnitInterface
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }
}