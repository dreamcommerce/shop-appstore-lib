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

final class Install extends Message
{
    /**
     * @var int
     */
    protected $applicationVersion;

    /**
     * @var string
     */
    protected $authCode;

    /**
     * @return int
     */
    public function getApplicationVersion(): int
    {
        return $this->applicationVersion;
    }

    /**
     * @return string
     */
    public function getAuthCode(): string
    {
        return $this->authCode;
    }

    /**
     * @param mixed $applicationVersion
     */
    protected function setApplicationVersion($applicationVersion): void
    {
        $this->applicationVersion = (int) $applicationVersion;
    }
}
