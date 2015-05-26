<?php

namespace DreamCommerce\Model\Shop;

interface ParcelAddressInterface extends AddressInterface
{
    const ADDRESS_TYPE_BILLING = 1;
    const ADDRESS_TYPE_DELIVERY = 2;

    /**
     * @return ParcelInterface
     */
    public function getParcel();

    /**
     * @param ParcelInterface $parcel
     * @return $this
     */
    public function setParcel(ParcelInterface $parcel);
}