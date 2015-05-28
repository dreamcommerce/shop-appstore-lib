<?php

namespace DreamCommerce\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Hydrator\Shop as ShopHydrator;
use DreamCommerce\Model\Shop\LanguageInterface;
use DreamCommerce\Model\Shop\UserAdditionalFieldInterface;
use DreamCommerce\Model\Shop\UserAddressInterface;
use DreamCommerce\Model\Shop\UserGroupInterface;
use DreamCommerce\Model\Shop\UserInterface;

class Client extends ShopHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  UserInterface $user
     * @return object
     */
    public function hydrate(array $data, $user)
    {
        if(isset($data['lang_id'])) {
            /** @var LanguageInterface $language */
            $language = $this->_getMappedObject('language', $data['lang_id'], false);
            $user->setLanguage($language);
        }

        if(isset($data['groups'])) {
            foreach($data['groups'] as $groupData) {
                /** @var UserGroupInterface $userGroup */
                $userGroup = $this->_getMappedObject('userGroup', $data['group_id']);
                $this->_fillObject($groupData, $userGroup);
                $user->addGroup($userGroup);
            }
            unset($data['groups']);
        }

        if(isset($data['addresses'])) {
            foreach($data['addresses'] as $addressData) {
                if(isset($addressData['tax_id'])) {
                    $addressData['tax_identification_number'] = $addressData['tax_id'];
                }

                /** @var UserAddressInterface $userAddress */
                $userAddress = $this->_getMappedObject('userAddress', $data['address_book_id']);
                $userAddress->setUser($user);
                $this->_fillObject($addressData, $userAddress);
                $user->addAddress($userAddress);
            }
            unset($data['addresses']);
        }

        if(isset($data['additional_fields'])) {
            foreach($data['additional_fields'] as $additionalData) {
                /** @var UserAdditionalFieldInterface $additionalField */
                $additionalField = $this->_getMappedObject('userAdditionalField', $additionalData['field_id']);
                $additionalField->setUser($user);
                $this->_fillObject($additionalData, $additionalField);
            }
            unset($data['additional_fields']);
        }

        $this->_fillObject($data, $user);
        return $user;
    }
}