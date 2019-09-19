<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Billing\Payload;

use DateTime;
use DateTimeZone;
use DreamCommerce\Component\Common\Model\ArrayableInterface;
use DreamCommerce\Component\Common\Model\ArrayableTrait;
use DreamCommerce\Component\ShopAppstore\Info;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;

abstract class Message implements ArrayableInterface
{
    use ArrayableTrait;

    /**
     * @var OAuthShopInterface
     */
    protected $shop;

    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var DateTime
     */
    protected $timestamp;

    /**
     * @param ApplicationInterface $application
     * @param OAuthShopInterface $shop
     * @param array $params
     */
    public function __construct(ApplicationInterface $application, OAuthShopInterface $shop, array $params = [])
    {
        $this->fromArray($params);

        $this->application = $application;
        $this->shop = $shop;
    }

    /**
     * @return OAuthShopInterface
     */
    public function getShop(): OAuthShopInterface
    {
        return $this->shop;
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @return DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp): void
    {
        if (!($timestamp instanceof DateTime)) {
            $timestamp = new DateTime($timestamp, new DateTimeZone(Info::TIMEZONE));
        }

        $this->timestamp = $timestamp;
    }
}
