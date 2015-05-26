<?php

namespace DreamCommerce\Model\Shop;

interface OptionInterface extends TranslationDependentInterface
{
    const TYPE_FILE = 'file';
    const TYPE_TEXT = 'text';
    const TYPE_RADIO = 'radio';
    const TYPE_SELECT = 'select';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_COLOR = 'color';

    const PRICE_TYPE_DECREASE_VALUE = -1;
    const PRICE_TYPE_KEEP_UNCHANGED = 0;
    const PRICE_TYPE_INCREASE_VALUE = 1;

    const CHANGE_PRICE_BY_AMOUNT = 0;
    const CHANGE_PRICE_BY_PERCENT = 1;

    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup(OptionGroupInterface $optionGroup);
}