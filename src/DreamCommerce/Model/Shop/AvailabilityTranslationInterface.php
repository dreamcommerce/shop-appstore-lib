<?php

namespace DreamCommerce\Model\Shop;

interface AvailabilityTranslationInterface extends TranslationInterface
{
    /**
     * @return AvailabilityInterface
     */
    public function getAvailability();

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability);
}