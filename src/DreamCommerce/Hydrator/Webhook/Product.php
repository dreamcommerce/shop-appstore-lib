<?php

namespace DreamCommerce\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Hydrator\Shop as ShopHydrator;
use DreamCommerce\Model\Shop\AvailabilityInterface;
use DreamCommerce\Model\Shop\CategoryInterface;
use DreamCommerce\Model\Shop\DeliveryInterface;
use DreamCommerce\Model\Shop\OptionGroupInterface;
use DreamCommerce\Model\Shop\ProducerInterface;
use DreamCommerce\Model\Shop\ProductFileInterface;
use DreamCommerce\Model\Shop\ProductImageInterface;
use DreamCommerce\Model\Shop\ProductInterface;
use DreamCommerce\Model\Shop\ProductStockInterface;
use DreamCommerce\Model\Shop\ProductTranslationInterface;
use DreamCommerce\Model\Shop\TaxInterface;
use DreamCommerce\Model\Shop\UnitInterface;

class Product extends ShopHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  ProductInterface $product
     * @return object
     */
    public function hydrate(array $data, $product)
    {
        if(isset($data['producer'])) {
            /** @var ProducerInterface $producer */
            $producer = $this->_getMappedObject('producer', $data['producer_id']);
            $this->_fillObject($data['producer'], $producer);
            $product->setProducer($producer);
            unset($data['producer']);
        } elseif(isset($data['producer_id'])) {
            /** @var ProducerInterface $producer */
            $producer = $this->_getMappedObject('producer', $data['producer_id'], false);
            $product->setProducer($producer);
        }

        if(isset($data['tax'])) {
            /** @var TaxInterface $tax */
            $tax = $this->_getMappedObject('tax', $data['tax']['tax_id']);
            $this->_fillObject($data['tax'], $tax);
            $product->setTax($tax);
            unset($data['tax']);
        } elseif(isset($data['tax_id'])) {
            $tax = $this->_getMappedObject('tax', $data['tax_id'], false);
            $product->setTax($tax);
        }

        if(isset($data['unit'])) {
            /** @var UnitInterface $unit */
            $unit = $this->_getMappedObject('unit', $data['unit_id']);
            $this->_fillObject($data['unit'], $unit);
            $product->setUnit($unit);
            unset($data['unit']);
        } elseif(isset($data['unit_id'])) {
            /** @var UnitInterface $unit */
            $unit = $this->_getMappedObject('unit', $data['unit_id'], false);
            $product->setUnit($unit);
        }

        if(isset($data['category_id'])) {
            /** @var CategoryInterface $category */
            $category = $this->_getMappedObject('category', $data['category_id'], false);
            $product->setCategory($category);
        }

        if(isset($data['group_id'])) {
            /** @var OptionGroupInterface $optionGroup */
            $optionGroup = $this->_getMappedObject('optionGroup', $data['group_id'], false);
            $product->setOptionGroup($optionGroup);
        }

        if(isset($data['specialOffer'])) {

        }

        if(isset($data['translations'])) {
            foreach($data['translations'] as $translationData) {
                /** @var ProductTranslationInterface $translation */
                $translation = $this->_getMappedObject('productTranslation', $translationData['translation_id']);
                $translation->setProduct($product);
                $this->_fillObject($translationData, $translation);
                if(isset($translationData['lang_id'])) {
                    $language = $this->_getMappedObject('language', $translationData['lang_id'], false);
                    $translation->setLanguage($language);
                }
                $product->addTranslation($translation);
            }
            unset($data['translations']);
        }

        if(isset($data['images'])) {
            foreach($data['images'] as $imageData) {
                /** @var ProductImageInterface $image */
                $image = $this->_getMappedObject('productImage', $imageData['gfx_id']);
                $image->setProduct($product);
                $this->_fillObject($imageData, $image);
                $product->addImage($image);
            }
            unset($data['images']);
        }

        if(isset($data['files'])) {
            foreach($data['files'] as $fileData) {
                /** @var ProductTranslationInterface $translation */
                $translation = $this->_getMappedObject('productTranslation', $fileData['translation_id']);
                /** @var ProductFileInterface $file */
                $file = $this->_getMappedObject('productFile', $fileData['file_id']);
                $file->setProductTranslation($translation);
                $this->_fillObject($fileData, $translation);
                $translation->addFile($file);
            }
            unset($data['files']);
        }

        if(isset($data['stock'])) {
            /** @var ProductStockInterface $productStock */
            $productStock = $this->_getMappedObject('productStock', $data['stock']['stock_id']);
            $productStock->setProduct($product);
            $this->_fillObject($data['stock'], $productStock);

            if(isset($data['stock']['availability'])) {
                /** @var AvailabilityInterface $availability */
                $availability = $this->_getMappedObject('availability', $data['availability']['availability_id']);
                $this->_fillObject($data['availability'], $availability);
                $productStock->setAvailability($availability);
            } elseif($data['stock']['availability_id']) {
                /** @var AvailabilityInterface $availability */
                $availability = $this->_getMappedObject('availability', $data['availability_id'], false);
                $productStock->setAvailability($availability);
            }

            if(isset($data['stock']['delivery'])) {
                /** @var DeliveryInterface $delivery */
                $delivery = $this->_getMappedObject('delivery', $data['delivery']['delivery_id']);
                $this->_fillObject($data['delivery'], $delivery);
                $productStock->setDelivery($delivery);
            } elseif($data['stock']['delivery_id']) {
                /** @var DeliveryInterface $delivery */
                $delivery = $this->_getMappedObject('delivery', $data['delivery_id'], false);
                $productStock->setDelivery($delivery);
            }

            if(isset($data['stock']['gfx_id'])) {
                $image = $this->_getMappedObject('productImage', $data['stock']['gfx_id'], false);
                $productStock->setImage($image);
            }

            if($data['stock']['options']) {
                foreach($data['stock']['options'] as $optionData) {

                }
            }

            $product->setProductStock($productStock);
            unset($data['stock']);
        }

        $this->_fillObject($data, $product);
        return $product;
    }
}