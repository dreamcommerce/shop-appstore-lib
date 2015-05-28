<?php

namespace DreamCommerce\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Hydrator\Shop as ShopHydrator;
use DreamCommerce\Model\Shop\OrderInterface;
use DreamCommerce\Model\Shop\ParcelAddressInterface;
use DreamCommerce\Model\Shop\ParcelInterface;
use DreamCommerce\Model\Shop\ParcelProductInterface;
use DreamCommerce\Model\Shop\ProductInterface;
use DreamCommerce\Model\Shop\ProductStockInterface;
use DreamCommerce\Model\Shop\ShippingInterface;
use DreamCommerce\Model\Shop\TaxInterface;

class Parcel extends ShopHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param ParcelInterface $parcel
     * @return object
     */
    public function hydrate(array $data, $parcel)
    {
        if(isset($data['order_id'])) {
            /** @var OrderInterface $order */
            $order = $this->_getMappedObject('order', $data['order_id'], false);
            $parcel->setOrder($order);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }

            /** @var ParcelAddressInterface $billingAddress */
            $billingAddress = $this->_getMappedObject('parcelBillingAddress', $data['billingAddress']['address_id']);
            $billingAddress->setParcel($parcel);
            $this->_fillObject($data['billingAddress'], $billingAddress);
            $parcel->setBillingAddress($billingAddress);
            unset($data['billingAddress']);
        }

        if(isset($data['deliveryAddress'])) {
            if(isset($data['deliveryAddress']['tax_id'])) {
                $data['deliveryAddress']['tax_identification_number'] = $data['deliveryAddress']['tax_id'];
            }

            /** @var ParcelAddressInterface $deliveryAddress */
            $deliveryAddress = $this->_getMappedObject('parcelDeliveryAddress', $data['deliveryAddress']['address_id']);
            $deliveryAddress->setParcel($parcel);
            $this->_fillObject($data['deliveryAddress'], $deliveryAddress);
            $parcel->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = $this->_getMappedObject('shipping', $data['shipping']['shipping_id']);
            $this->_fillObject($data['shipping'], $shipping);
            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = $this->_getMappedObject('tax', $data['shipping']['tax_id'], false);
                $shipping->setTax($tax);
            }

            $parcel->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var ParcelProductInterface $parcelProduct */
                $parcelProduct = $this->_getMappedObject('parcelProduct', $productData['id']);
                $this->_fillObject($productData, $parcelProduct);

                if(isset($productData['product_id'])) {
                    /** @var ProductInterface $product */
                    $product = $this->_getMappedObject('product', $productData['product_id'], false);
                    $parcelProduct->setProduct($product);
                }

                if(isset($productData['stock_id'])) {
                    /** @var ProductStockInterface $productStock */
                    $productStock = $this->_getMappedObject('productStock', $productData['stock_id'], false);
                    $parcelProduct->setProductStock($productStock);
                }

                $parcel->addProduct($parcelProduct);
            }
            unset($data['products']);
        }

        $this->_fillObject($data, $parcel);
        return $parcel;
    }
}