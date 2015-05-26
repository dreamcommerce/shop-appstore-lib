<?php

namespace DreamCommerce\Model\Shop;

interface UnitTranslationInterface extends TranslationInterface
{
    /**
     * @return UnitInterface
     */
    public function getUnit();

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit($unit);
}