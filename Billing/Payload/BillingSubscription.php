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
use DreamCommerce\Component\ShopAppstore\Info;

final class BillingSubscription extends Message
{
    /**
     * @var DateTime
     */
    protected $subscriptionEndTime;

    /**
     * @return DateTime
     */
    public function getSubscriptionEndTime(): DateTime
    {
        return $this->subscriptionEndTime;
    }

    /**
     * @param mixed $subscriptionEndTime
     */
    public function setSubscriptionEndTime($subscriptionEndTime): void
    {
        if (!($subscriptionEndTime instanceof DateTime)) {
            $subscriptionEndTime = new DateTime($subscriptionEndTime, new DateTimeZone(Info::TIMEZONE));
        }

        $this->subscriptionEndTime = $subscriptionEndTime;
    }
}
