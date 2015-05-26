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
     * @return \ArrayAccess
     */
    public function getFiles();

    /**
     * @param ProductFileInterface $file
     * @return $this
     */
    public function addFile(ProductFileInterface $file);

    /**
     * @param \ArrayAccess $files
     * @return $this
     */
    public function setFiles(\ArrayAccess $files);

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
    public function getStock();

    /**
     * @param ProductStockInterface $stock
     * @return $this
     */
    public function setStock(ProductStockInterface $stock);
}