<?php

namespace DreamCommerce\Model\Shop;

class OptionValueTranslation implements OptionValueTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var OptionValueInterface
     */
    protected $optionValue;

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

    /**
     * @return OptionValueInterface
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function setOptionValue(OptionValueInterface $optionValue)
    {
        $this->optionValue = $optionValue;
        return $this;
    }
}