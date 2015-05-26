<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Language implements LanguageInterface
{
    /**
     * @var int
     */
    protected $languageId;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var \ArrayAccess
     */
    protected $aboutPages;

    /**
     * @var \ArrayAccess
     */
    protected $attributeGroups;

    /**
     * @var \ArrayAccess
     */
    protected $attributes;

    /**
     * @var \ArrayAccess
     */
    protected $availabilityTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $categoryTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $deliveryTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $gaugeTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $paymentTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $productTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $shippings;

    /**
     * @var \ArrayAccess
     */
    protected $statusTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $unitTranslations;

    /**
     * @var \ArrayAccess
     */
    protected $users;

    /**
     * @var \ArrayAccess
     */
    protected $options;

    /**
     * @var \ArrayAccess
     */
    protected $optionGroups;

    /**
     * @var \ArrayAccess
     */
    protected $optionValues;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {
        $this->aboutPages = new \ArrayObject();
        $this->attributeGroups = new \ArrayObject();
        $this->availabilityTranslations = new \ArrayObject();
        $this->categoryTranslations = new \ArrayObject();
        $this->deliveryTranslations = new \ArrayObject();
        $this->gaugeTranslations = new \ArrayObject();
        $this->paymentTranslations = new \ArrayObject();
        $this->productTranslations = new \ArrayObject();
        $this->shippings = new \ArrayObject();
        $this->statusTranslations = new \ArrayObject();
        $this->unitTranslations = new \ArrayObject();
        $this->users = new \ArrayObject();
        $this->options = new \ArrayObject();
        $this->optionGroups = new \ArrayObject();
        $this->optionValues = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return $this
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAboutPages()
    {
        return $this->aboutPages;
    }

    /**
     * @param \ArrayAccess $aboutPages
     * @return $this
     */
    public function setAboutPages($aboutPages)
    {
        $this->aboutPages = $aboutPages;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAttributeGroups()
    {
        return $this->attributeGroups;
    }

    /**
     * @param \ArrayAccess $attributeGroups
     * @return $this
     */
    public function setAttributeGroups($attributeGroups)
    {
        $this->attributeGroups = $attributeGroups;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \ArrayAccess $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAvailabilityTranslations()
    {
        return $this->availabilityTranslations;
    }

    /**
     * @param \ArrayAccess $availabilityTranslations
     * @return $this
     */
    public function setAvailabilityTranslations($availabilityTranslations)
    {
        $this->availabilityTranslations = $availabilityTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getCategoryTranslations()
    {
        return $this->categoryTranslations;
    }

    /**
     * @param \ArrayAccess $categoryTranslations
     * @return $this
     */
    public function setCategoryTranslations($categoryTranslations)
    {
        $this->categoryTranslations = $categoryTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getDeliveryTranslations()
    {
        return $this->deliveryTranslations;
    }

    /**
     * @param \ArrayAccess $deliveryTranslations
     * @return $this
     */
    public function setDeliveryTranslations($deliveryTranslations)
    {
        $this->deliveryTranslations = $deliveryTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getGaugeTranslations()
    {
        return $this->gaugeTranslations;
    }

    /**
     * @param \ArrayAccess $gaugeTranslations
     * @return $this
     */
    public function setGaugeTranslations($gaugeTranslations)
    {
        $this->gaugeTranslations = $gaugeTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getPaymentTranslations()
    {
        return $this->paymentTranslations;
    }

    /**
     * @param \ArrayAccess $paymentTranslations
     * @return $this
     */
    public function setPaymentTranslations($paymentTranslations)
    {
        $this->paymentTranslations = $paymentTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProductTranslations()
    {
        return $this->productTranslations;
    }

    /**
     * @param \ArrayAccess $productTranslations
     * @return $this
     */
    public function setProductTranslations($productTranslations)
    {
        $this->productTranslations = $productTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getShippings()
    {
        return $this->shippings;
    }

    /**
     * @param \ArrayAccess $shippings
     * @return $this
     */
    public function setShippings($shippings)
    {
        $this->shippings = $shippings;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getStatusTranslations()
    {
        return $this->statusTranslations;
    }

    /**
     * @param \ArrayAccess $statusTranslations
     * @return $this
     */
    public function setStatusTranslations($statusTranslations)
    {
        $this->statusTranslations = $statusTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getUnitTranslations()
    {
        return $this->unitTranslations;
    }

    /**
     * @param \ArrayAccess $unitTranslations
     * @return $this
     */
    public function setUnitTranslations($unitTranslations)
    {
        $this->unitTranslations = $unitTranslations;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \ArrayAccess $users
     * @return $this
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $this;
    }

    /**
     * @param AboutPageInterface $aboutPage
     * @return $this
     */
    public function addAboutPage(AboutPageInterface $aboutPage)
    {
        $this->aboutPages[] = $aboutPage;
        return $this;
    }

    /**
     * @param AttributeGroup $attributeGroup
     * @return $this
     */
    public function addAttributeGroup(AttributeGroup $attributeGroup)
    {
        $this->attributeGroups[] = $attributeGroup;
        return $this;
    }

    /**
     * @param AvailabilityTranslationInterface $availabilityTranslation
     * @return $this
     */
    public function addAvailabilityTranslation(AvailabilityTranslationInterface $availabilityTranslation)
    {
        $this->availabilityTranslations[] = $availabilityTranslation;
        return $this;
    }

    /**
     * @param CategoryTranslationInterface $categoryTranslation
     * @return $this
     */
    public function addCategoryTranslation(CategoryTranslationInterface $categoryTranslation)
    {
        $this->categoryTranslations[] = $categoryTranslation;
        return $this;
    }

    /**
     * @param DeliveryTranslation $deliveryTranslation
     * @return $this
     */
    public function addDeliveryTranslation(DeliveryTranslation $deliveryTranslation)
    {
        $this->deliveryTranslations[] = $deliveryTranslation;
        return $this;
    }

    /**
     * @param GaugeTranslationInterface $gaugeTranslation
     * @return $this
     */
    public function addGaugeTranslation(GaugeTranslationInterface $gaugeTranslation)
    {
        $this->gaugeTranslations[] = $gaugeTranslation;
        return $this;
    }

    /**
     * @param PaymentTranslationInterface $paymentTranslation
     * @return $this
     */
    public function addPaymentTranslation(PaymentTranslationInterface $paymentTranslation)
    {
        $this->paymentTranslations[] = $paymentTranslation;
        return $this;
    }

    /**
     * @param ProductTranslationInterface $productTranslation
     * @return $this
     */
    public function addProductTranslation(ProductTranslationInterface $productTranslation)
    {
        $this->productTranslations[] = $productTranslation;
        return $this;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function addShipping(ShippingInterface $shipping)
    {
        $this->shippings[] = $shipping;
        return $this;
    }

    /**
     * @param StatusTranslationInterface $statusTranslation
     * @return $this
     */
    public function addStatusTranslation(StatusTranslationInterface $statusTranslation)
    {
        $this->statusTranslations[] = $statusTranslation;
        return $this;
    }

    /**
     * @param UnitTranslationInterface $unitTranslation
     * @return $this
     */
    public function addUnitTranslation(UnitTranslationInterface $unitTranslation)
    {
        $this->unitTranslations[] = $unitTranslation;
        return $this;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option)
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * @param \ArrayAccess $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptionGroups()
    {
        return $this->optionGroups;
    }

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function addOptionGroup(OptionGroupInterface $optionGroup)
    {
        $this->optionGroups[] = $optionGroup;
        return $this;
    }

    /**
     * @param \ArrayAccess $optionGroups
     * @return $this
     */
    public function setOptionGroups($optionGroups)
    {
        $this->optionGroups = $optionGroups;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptionValues()
    {
        return $this->optionValues;
    }

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function addOptionValue(OptionValueInterface $optionValue)
    {
        $this->optionValues[] = $optionValue;
    }

    /**
     * @param \ArrayAccess $optionValues
     * @return $this
     */
    public function setOptionValues($optionValues)
    {
        $this->optionValues = $optionValues;
        return $this;
    }
}