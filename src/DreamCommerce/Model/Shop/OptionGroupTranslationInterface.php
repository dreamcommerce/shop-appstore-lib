<?php

namespace DreamCommerce\Model\Shop;

interface OptionGroupTranslationInterface extends TranslationInterface
{
    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup($optionGroup);
}