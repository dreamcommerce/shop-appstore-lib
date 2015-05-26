<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

class Parcel implements ParcelInterface
{
    /**
     * @var int
     */
    protected $parcelId;

    /**
     * @var string
     */
    protected $shippingCode;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var \DateTime
     */
    protected $sendDate;

    /**
     * @var \DateTime
     */
    protected $deliveryDate;

    /**
     * @var \DateTime
     */
    protected $orderDate;

    /**
     * @var boolean
     */
    protected $insurance;

    /**
     * @var float
     */
    protected $insuranceCost;

    /**
     * @var boolean
     */
    protected $cod;

    /**
     * @var float
     */
    protected $codCost;

    /**
     * @var string
     */
    protected $notes;

    /**
     * @var boolean
     */
    protected $sent;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var ShippingInterface
     */
    protected $shipping;

    /**
     * @var ParcelAddressInterface
     */
    protected $deliveryAddress;

    /**
     * @var ParcelAddressInterface
     */
    protected $billingAddress;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    /**
     * @return int
     */
    public function getParcelId()
    {
        return $this->parcelId;
    }

    /**
     * @param int $parcelId
     * @return $this
     */
    public function setParcelId($parcelId)
    {
        $this->parcelId = $parcelId;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCode()
    {
        return $this->shippingCode;
    }

    /**
     * @param string $shippingCode
     * @return $this
     */
    public function setShippingCode($shippingCode)
    {
        $this->shippingCode = $shippingCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @param \DateTime $sendDate
     * @return $this
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime $deliveryDate
     * @return $this
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     * @return $this
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isInsurance()
    {
        return $this->insurance;
    }

    /**
     * @param boolean $insurance
     * @return $this
     */
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;
        return $this;
    }

    /**
     * @return float
     */
    public function getInsuranceCost()
    {
        return $this->insuranceCost;
    }

    /**
     * @param float $insuranceCost
     * @return $this
     */
    public function setInsuranceCost($insuranceCost)
    {
        $this->insuranceCost = $insuranceCost;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCod()
    {
        return $this->cod;
    }

    /**
     * @param boolean $cod
     * @return $this
     */
    public function setCod($cod)
    {
        $this->cod = $cod;
        return $this;
    }

    /**
     * @return float
     */
    public function getCodCost()
    {
        return $this->codCost;
    }

    /**
     * @param float $codCost
     * @return $this
     */
    public function setCodCost($codCost)
    {
        $this->codCost = $codCost;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return $this
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isSent()
    {
        return $this->sent;
    }

    /**
     * @param boolean $sent
     * @return $this
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
        return $this;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return ShippingInterface
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return ParcelAddressInterface
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param ParcelAddressInterface $deliveryAddress
     * @return $this
     */
    public function setDeliveryAddress(ParcelAddressInterface $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    /**
     * @return ParcelAddressInterface
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param ParcelAddressInterface $billingAddress
     * @return $this
     */
    public function setBillingAddress(ParcelAddressInterface $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ParcelProductInterface $product
     * @return $this
     */
    public function addProduct(ParcelProductInterface $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
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
}