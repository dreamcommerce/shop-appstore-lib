<?php

namespace DreamCommerce\Model\Shop;

interface LanguageDependentInterface
{
    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language);

    /**
     * @return LanguageInterface
     */
    public function getLanguage();
}