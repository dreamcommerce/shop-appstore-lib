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

final class Upgrade extends Message
{
    /**
     * @var int
     */
    protected $applicationVersion;

    /**
     * @return int
     */
    public function getApplicationVersion(): int
    {
        return $this->applicationVersion;
    }

    /**
     * @param mixed $applicationVersion
     */
    protected function setApplicationVersion($applicationVersion): void
    {
        $this->applicationVersion = (int) $applicationVersion;
    }
}
