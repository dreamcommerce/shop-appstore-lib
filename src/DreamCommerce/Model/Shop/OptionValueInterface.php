<?php

namespace DreamCommerce\Model\Shop;

interface OptionValueInterface extends TranslationDependentInterface
{
    /**
     * @return OptionInterface
     */
    public function getOption();

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption(OptionInterface $option);
}