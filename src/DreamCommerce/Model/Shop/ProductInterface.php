<?php

namespace DreamCommerce\Model\Shop;

interface ProductInterface extends TranslationDependentInterface, ShopDependentInterface
{
    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup(OptionGroupInterface $optionGroup);

    /**
     * @return \ArrayAccess
     */
    public function getImages();

    /**
     * @param ProductImageInterface $image
     * @return $this
     */
    public function addImage(ProductImageInterface $image);

    /**
     * @param \ArrayAccess $images
     * @return $this
     */
    public function setImages(\ArrayAccess $images);

    /**
     * @return ProducerInterface
     */
    public function getProducer();

    /**
     * @param ProducerInterface $producer
     * @return $this
     */
    public function setProducer(ProducerInterface $producer);

    /**
     * @return TaxInterface
     */
    public function getTax();

    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax(TaxInterface $tax);

    /**
     * @return UnitInterface
     */
    public function getUnit();

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit(UnitInterface $unit);

    /**
     * @return ProductVoteInterface
     */
    public function getVote();

    /**
     * @param ProductVoteInterface $vote
     * @return $this
     */
    public function setVote(ProductVoteInterface $vote);

    /**
     * @return ProductSpecialOfferInterface
     */
    public function getSpecialOffer();

    /**
     * @param ProductSpecialOfferInterface $specialOffer
     * @return $this
     */
    public function setSpecialOffer(ProductSpecialOfferInterface $specialOffer);

    /**
     * @return \ArrayAccess
     */
    public function getAttributes();

    /**
     * @param AttributeInterface $attribute
     * @return $this
     */
    public function addAttribute(AttributeInterface $attribute);

    /**
     * @param \ArrayAccess $attributes
     * @return $this
     */
    public function setAttributes(\ArrayAccess $attributes);

    /**
     * @return \ArrayAccess
     */
    public function getCategories();

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function addCategory(CategoryInterface $category);

    /**
     * @param \ArrayAccess $categories
     * @return $this
     */
    public function setCategories($categories);

    /**
     * @return ProductStockInterface
     */
    public function getProductStock();

    /**
     * @param ProductStockInterface $stock
     * @return $this
     */
    public function setProductStock(ProductStockInterface $stock);

    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function setCategory(CategoryInterface $category);

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
}