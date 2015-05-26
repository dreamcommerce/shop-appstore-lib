<?php

namespace DreamCommerce\Model\Shop;

interface TranslationDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getTranslations();

    /**
     * @param TranslationInterface $translation
     * @return $this
     */
    public function addTranslation(TranslationInterface $translation);

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations);
}