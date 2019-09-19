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

interface TokenInterface extends ResourceInterface, ShopDependInterface
{
    /**
     * @param DateTime $expiresAt
     */
    public function setExpiresAt(?DateTime $expiresAt): void;

    /**
     * @return DateTime|null
     */
    public function getExpiresAt(): ?DateTime;

    /**
     * @param string $accessToken
     */
    public function setAccessToken(?string $accessToken): void;

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string;

    /**
     * @param string|null $refreshToken
     */
    public function setRefreshToken(?string $refreshToken): void;

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string;

    /**
     * @return array
     */
    public function getScopes(): array;

    /**
     * @param array $scopes
     */
    public function setScopes(array $scopes): void;
}
