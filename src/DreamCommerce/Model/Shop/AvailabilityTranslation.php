<?php

namespace DreamCommerce\Model\Shop;

class AvailabilityTranslation implements AvailabilityTranslationInterface
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
     * @var AvailabilityInterface
     */
    protected $availability;

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
     * @return AvailabilityInterface
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability)
    {
        $this->availability = $availability;
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