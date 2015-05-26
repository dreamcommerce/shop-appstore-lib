<?php

namespace DreamCommerce\Model\Shop;

interface GaugeTranslationInterface extends LanguageDependentInterface
{
    /**
     * @return GaugeInterface
     */
    public function getGauge();

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function setGauge(GaugeInterface $gauge);
}