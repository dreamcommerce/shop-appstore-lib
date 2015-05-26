<?php

namespace DreamCommerce\Model\Shop;

interface ShippingInterface extends LanguageDependentInterface, ShopDependentInterface
{
    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax($tax);

    /**
     * @return \ArrayAccess
     */
    public function getRanges();

    /**
     * @param ShippingRange $range
     * @return $this
     */
    public function addRange(ShippingRange $range);

    /**
     * @param \ArrayAccess $ranges
     * @return $this
     */
    public function setRanges($ranges);

    /**
     * @return \ArrayAccess
     */
    public function getPayments();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment);

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments);

    /**
     * @return \ArrayAccess
     */
    public function getGauges();

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function addGauge(GaugeInterface $gauge);

    /**
     * @param \ArrayAccess $gauges
     * @return $this
     */
    public function setGauges($gauges);
}