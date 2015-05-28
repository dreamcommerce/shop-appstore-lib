<?php

namespace DreamCommerce\Hydrator;

use DreamCommerce\Exception;
use DreamCommerce\Hydrator\Webhook\Order as OrderHydrator;
use DreamCommerce\Hydrator\Webhook\Parcel as ParcelHydrator;
use DreamCommerce\Hydrator\Webhook\Product as ProductHydrator;
use DreamCommerce\Hydrator\Webhook\Client as ClientHydrator;
use DreamCommerce\Model\Shop\OrderInterface;
use DreamCommerce\Model\Shop\ParcelInterface;
use DreamCommerce\Model\Shop\ProductInterface;
use DreamCommerce\Model\Shop\ShopDependentInterface;
use DreamCommerce\Model\Shop\UserInterface;

class Webhook extends Shop
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     * @throws Exception
     */
    public function hydrate(array $data, $object)
    {
        if(!($object instanceof ShopDependentInterface)) {
            throw new Exception('Cannot hydrate object');
        }

        /** @var Shop $hydrator */
        $hydrator = null;
        if($object instanceof OrderInterface) {
            $hydrator = new OrderHydrator($this->_shop);
        } elseif($object instanceof UserInterface) {
            $hydrator = new ClientHydrator($this->_shop);
        } elseif($object instanceof ProductInterface) {
            $hydrator = new ProductHydrator($this->_shop);
        } elseif($object instanceof ParcelInterface) {
            $hydrator = new ParcelHydrator($this->_shop);
        } else {
            throw new Exception('Unsupported type of object to hydrate');
        }

        return $hydrator->hydrateName($data, $object);
    }
}