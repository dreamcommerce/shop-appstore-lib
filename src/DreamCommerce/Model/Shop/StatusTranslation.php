<?php

namespace DreamCommerce\Model\Shop;

abstract class StatusTranslation implements StatusTranslationInterface
{
    /**
     * @var int
     */
    protected $transId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $messageHtml;

    /**
     * @var StatusInterface
     */
    protected $status;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @return int
     */
    public function getTransId()
    {
        return $this->transId;
    }

    /**
     * @param int $transId
     * @return $this
     */
    public function setTransId($transId)
    {
        $this->transId = $transId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageHtml()
    {
        return $this->messageHtml;
    }

    /**
     * @param string $messageHtml
     * @return $this
     */
    public function setMessageHtml($messageHtml)
    {
        $this->messageHtml = $messageHtml;
        return $this;
    }

    /**
     * @return StatusInterface
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param StatusInterface $status
     * @return $this
     */
    public function setStatus(StatusInterface $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return Language
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
}