<?php

namespace DreamCommerce\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Hydrator\Shop as ShopHydrator;
use DreamCommerce\Model\Shop\AuctionInterface;
use DreamCommerce\Model\Shop\AuctionOrderInterface;
use DreamCommerce\Model\Shop\CurrencyInterface;
use DreamCommerce\Model\Shop\LanguageInterface;
use DreamCommerce\Model\Shop\OrderAdditionalFieldInterface;
use DreamCommerce\Model\Shop\OrderAddressInterface;
use DreamCommerce\Model\Shop\OrderInterface;
use DreamCommerce\Model\Shop\OrderProductInterface;
use DreamCommerce\Model\Shop\PaymentInterface;
use DreamCommerce\Model\Shop\PaymentTranslationInterface;
use DreamCommerce\Model\Shop\ProductInterface;
use DreamCommerce\Model\Shop\ProductStockInterface;
use DreamCommerce\Model\Shop\PromoCodeInterface;
use DreamCommerce\Model\Shop\ShippingInterface;
use DreamCommerce\Model\Shop\StatusTranslationInterface;
use DreamCommerce\Model\Shop\StatusInterface;
use DreamCommerce\Model\Shop\TaxInterface;
use DreamCommerce\Model\Shop\UserInterface;

class Order extends ShopHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  OrderInterface $order
     * @return object
     */
    public function hydrate(array $data, $order)
    {
        if(isset($data['user_id']) && is_null($data['user_id'])) {
            /** @var UserInterface $user */
            $user = $this->_getMappedObject('user', $data['user_id'], false);
            $order->setUser($user);
        }

        if(isset($data['currency_id'])) {
            /** @var CurrencyInterface $currency */
            $currency = $this->_getMappedObject('currency', $data['currency_id'], false);
            $order->setCurrency($currency);
        }

        if(isset($data['lang_id'])) {
            /** @var LanguageInterface $language */
            $language = $this->_getMappedObject('language', $data['lang_id'], false);
            $order->setLanguage($language);
        }

        if(isset($data['code_id'])) {
            /** @var PromoCodeInterface $promoCode */
            $promoCode = $this->_getMappedObject('promoCode', $data['code_id'], false);
            $order->setPromoCode($promoCode);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }
            /** @var OrderAddressInterface $billingAddress */
            $billingAddress = $this->_getMappedObject('orderBillingAddress', $data['billingAddress']['address_id']);
            $billingAddress->setOrder($order);
            $this->_fillObject($data['billingAddress'], $billingAddress);
            $order->setBillingAddress($billingAddress);
            unset($data['billingAddress']);
        }

        if(isset($data['deliveryAddress'])) {
            if(isset($data['deliveryAddress']['tax_id'])) {
                $data['deliveryAddress']['tax_identification_number'] = $data['deliveryAddress']['tax_id'];
            }
            /** @var OrderAddressInterface $deliveryAddress */
            $deliveryAddress = $this->_getMappedObject('orderDeliveryAddress', $data['deliveryAddress']['address_id']);
            $deliveryAddress->setOrder($order);
            $this->_fillObject($data['deliveryAddress'], $deliveryAddress);
            $order->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['auction'])) {
            /** @var AuctionOrderInterface $auctionOrder */
            $auctionOrder = $this->_getMappedObject('auctionOrder', $data['auction']['auction_order_id']);
            $auctionOrder->setOrder($order);
            $this->_fillObject($data['auction'], $auctionOrder);
            $order->setAuctionOrder($auctionOrder);

            /** @var AuctionInterface $auction */
            $auction = $this->_getMappedObject('auction', $data['auction']['auction_id'], false);
            $auctionOrder->setAuction($auction);
            unset($data['auction']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = $this->_getMappedObject('shipping', $data['shipping_id']);
            $this->_fillObject($data['shipping'], $shipping);

            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = $this->_getMappedObject('tax', $data['shipping']['tax_id'], false);
                $shipping->setTax($tax);
            }
            $order->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['status'])) {
            /** @var StatusInterface $status */
            $status = $this->_getMappedObject('status', $data['status_id']);
            $this->_fillObject($data['status'], $status);
            $order->setStatus($status);

            /** @var StatusTranslationInterface $statusTranslation */
            $statusTranslation = $this->_getMappedObject('statusTranslation');
            $this->_fillObject(array(
                'status_id' => $data['status']['status_id'],
                'lang_id' => $data['lang_id'],
                'name' => $data['status']['name'],
                'message' => $data['status']['message']
            ), $statusTranslation);
            $statusTranslation->setStatus($status);
            $status->addTranslation($statusTranslation);

            unset($data['status']);
        }

        if(isset($data['payment'])) {
            /** @var PaymentInterface $payment */
            $payment = $this->_getMappedObject('payment', $data['payment_id']);
            $this->_fillObject($data['payment'], $payment);
            $order->setPayment($payment);

            /** @var PaymentTranslationInterface $paymentTranslation */
            $paymentTranslation = $this->_getMappedObject('paymentTranslation');
            $this->_fillObject(array(
                'lang_id' => $data['lang_id'],
                'payment_id' => $data['payment']['payment_id'],
                'title' => $data['payment']['title'],
                'description' => $data['payment']
            ), $paymentTranslation);

            /** @var LanguageInterface $language */
            $language = $this->_getMappedObject('language', $data['lang_id'], false);
            $paymentTranslation->setLanguage($language);
            $paymentTranslation->setPayment($payment);
            $payment->addTranslation($paymentTranslation);

            unset($data['payment']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var OrderProductInterface $orderProduct */
                $orderProduct = $this->_getMappedObject('orderProduct', $productData['id']);
                $orderProduct->setOrder($order);

                /** @var ProductInterface $product */
                $product = $this->_getMappedObject('product', $productData['product_id'], false);
                $orderProduct->setProduct($product);

                /** @var ProductStockInterface $productStock */
                $productStock = $this->_getMappedObject('productStock', $productData['stock_id'], false);
                $orderProduct->setProductStock($productStock);

                $this->_fillObject($productData, $orderProduct);
                $order->addProduct($orderProduct);
            }
            unset($data['products']);
        }

        if(isset($data['additional_fields'])) {
            foreach($data['additional_fields'] as $additionalData) {
                /** @var OrderAdditionalFieldInterface $additionalField */
                $additionalField = $this->_getMappedObject('orderAdditionalField', $additionalData['field_id']);
                $additionalField->setOrder($order);

                $this->_fillObject($additionalData, $additionalField);
                $order->addAdditionalField($additionalField);
            }
            unset($data['additional_fields']);
        }

        $this->_fillObject($data, $order);
        return $order;
    }
}