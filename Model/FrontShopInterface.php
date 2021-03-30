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

interface FrontShopInterface extends BasicAuthShopInterface
{
    /**
     * @return string
     */
    public function getLanguage(): string;

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void;

    public function getRequestBasicHeaders(): array;

    public function hasSession(): bool;

    public function getSession(): string;

    public function setSession(string $session): void;

    public function clearSessions(): void;
}
