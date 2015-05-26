<?php

namespace DreamCommerce\Model\Shop;

abstract class ParcelAddress extends Address implements ParcelAddressInterface
{
    /**
     * @var int
     */
    protected $type;

    /**
     * @var ParcelInterface
     */
    protected $parcel;

    /**
     * @return ParcelInterface
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * @param ParcelInterface $parcel
     * @return $this
     */
    public function setParcel(ParcelInterface $parcel)
    {
        $this->parcel = $parcel;
        return $this;
    }
}