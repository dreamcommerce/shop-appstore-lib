<?php

namespace DreamCommerce\Model\Shop;

class PaymentTranslation implements PaymentTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $notify;

    /**
     * @var string
     */
    protected $notifyMail;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var PaymentInterface
     */
    protected $payment;

    /**
     * @return int
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotify()
    {
        return $this->notify;
    }

    /**
     * @param string $notify
     * @return $this
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyMail()
    {
        return $this->notifyMail;
    }

    /**
     * @param string $notifyMail
     * @return $this
     */
    public function setNotifyMail($notifyMail)
    {
        $this->notifyMail = $notifyMail;
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
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return PaymentInterface
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function setPayment(PaymentInterface $payment)
    {
        $this->payment = $payment;
        return $this;
    }
}