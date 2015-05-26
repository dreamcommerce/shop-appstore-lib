<?php

namespace DreamCommerce\Model\Shop;

abstract class ProductVote implements ProductVoteInterface
{
    /**
     * @var int
     */
    protected $voteId;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var int
     */
    protected $votes;

    /**
     * @var ProductInterface
     */
    protected $product;

    /**
     * @return int
     */
    public function getVoteId()
    {
        return $this->voteId;
    }

    /**
     * @param int $voteId
     * @return $this
     */
    public function setVoteId($voteId)
    {
        $this->voteId = $voteId;
        return $this;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     * @return $this
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return int
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param int $votes
     * @return $this
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
        return $this;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
        return $this;
    }
}