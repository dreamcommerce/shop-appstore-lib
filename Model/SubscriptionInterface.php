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

namespace DreamCommerce\Component\ShopAppstore\Model;

use DateTime;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface SubscriptionInterface extends ResourceInterface, ShopDependInterface, TimestampableInterface
{
    /**
     * @param DateTime|null $expiresAt
     */
    public function setExpiresAt(?DateTime $expiresAt): void;

    /**
     * @return DateTime|null
     */
    public function getExpiresAt(): ?DateTime;
}
