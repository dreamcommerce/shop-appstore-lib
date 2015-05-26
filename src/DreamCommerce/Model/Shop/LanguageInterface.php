<?php

namespace DreamCommerce\Model\Shop;

interface LanguageInterface extends ShopDependentInterface
{
    /**
     * @return CurrencyInterface
     */
    public function getCurrency();

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency);

    /**
     * @return \ArrayAccess
     */
    public function getAboutPages();

    /**
     * @param AboutPageInterface $aboutPage
     * @return $this
     */
    public function addAboutPage(AboutPageInterface $aboutPage);

    /**
     * @param \ArrayAccess $aboutPages
     * @return $this
     */
    public function setAboutPages($aboutPages);

    /**
     * @return \ArrayAccess
     */
    public function getAttributeGroups();

    /**
     * @param AttributeGroup $attributeGroup
     * @return $this
     */
    public function addAttributeGroup(AttributeGroup $attributeGroup);

    /**
     * @param \ArrayAccess $attributeGroups
     * @return $this
     */
    public function setAttributeGroups($attributeGroups);

    /**
     * @return \ArrayAccess
     */
    public function getAvailabilityTranslations();

    /**
     * @param AvailabilityTranslationInterface $availabilityTranslation
     * @return $this
     */
    public function addAvailabilityTranslation(AvailabilityTranslationInterface $availabilityTranslation);

    /**
     * @param \ArrayAccess $availabilityTranslations
     * @return $this
     */
    public function setAvailabilityTranslations($availabilityTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getCategoryTranslations();

    /**
     * @param CategoryTranslationInterface $categoryTranslation
     * @return $this
     */
    public function addCategoryTranslation(CategoryTranslationInterface $categoryTranslation);

    /**
     * @param \ArrayAccess $categoryTranslations
     * @return $this
     */
    public function setCategoryTranslations($categoryTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getDeliveryTranslations();

    /**
     * @param DeliveryTranslation $deliveryTranslation
     * @return $this
     */
    public function addDeliveryTranslation(DeliveryTranslation $deliveryTranslation);

    /**
     * @param \ArrayAccess $deliveryTranslations
     * @return $this
     */
    public function setDeliveryTranslations($deliveryTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getGaugeTranslations();

    /**
     * @param GaugeTranslationInterface $gaugeTranslation
     * @return $this
     */
    public function addGaugeTranslation(GaugeTranslationInterface $gaugeTranslation);

    /**
     * @param \ArrayAccess $gaugeTranslations
     * @return $this
     */
    public function setGaugeTranslations($gaugeTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getPaymentTranslations();

    /**
     * @param PaymentTranslationInterface $paymentTranslation
     * @return $this
     */
    public function addPaymentTranslation(PaymentTranslationInterface $paymentTranslation);

    /**
     * @param \ArrayAccess $paymentTranslations
     * @return $this
     */
    public function setPaymentTranslations($paymentTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getProductTranslations();

    /**
     * @param ProductTranslationInterface $productTranslation
     * @return $this
     */
    public function addProductTranslation(ProductTranslationInterface $productTranslation);

    /**
     * @param \ArrayAccess $productTranslations
     * @return $this
     */
    public function setProductTranslations($productTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getShippings();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function addShipping(ShippingInterface $shipping);

    /**
     * @param \ArrayAccess $shippings
     * @return $this
     */
    public function setShippings($shippings);

    /**
     * @return \ArrayAccess
     */
    public function getStatusTranslations();

    /**
     * @param StatusTranslationInterface $statusTranslation
     * @return $this
     */
    public function addStatusTranslation(StatusTranslationInterface $statusTranslation);

    /**
     * @param \ArrayAccess $statusTranslations
     * @return $this
     */
    public function setStatusTranslations($statusTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getUnitTranslations();

    /**
     * @param UnitTranslationInterface $unitTranslation
     * @return $this
     */
    public function addUnitTranslation(UnitTranslationInterface $unitTranslation);

    /**
     * @param \ArrayAccess $unitTranslations
     * @return $this
     */
    public function setUnitTranslations($unitTranslations);

    /**
     * @return \ArrayAccess
     */
    public function getUsers();

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user);

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users);

    /**
     * @return \ArrayAccess
     */
    public function getOptions();

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option);

    /**
     * @param \ArrayAccess $options
     * @return $this
     */
    public function setOptions($options);

    /**
     * @return \ArrayAccess
     */
    public function getOptionGroups();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function addOptionGroup(OptionGroupInterface $optionGroup);

    /**
     * @param \ArrayAccess $optionGroups
     * @return $this
     */
    public function setOptionGroups($optionGroups);

    /**
     * @return \ArrayAccess
     */
    public function getOptionValues();

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function addOptionValue(OptionValueInterface $optionValue);

    /**
     * @param \ArrayAccess $optionValues
     * @return $this
     */
    public function setOptionValues($optionValues);
}