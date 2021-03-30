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

class FrontShop extends BasicAuthShop implements FrontShopInterface
{
    /**
     * @var string
     */
    private $language = 'en_US';

    /**
     * @var string|null
     */
    private $session;

    /**
     * {@inheritDoc}
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * {@inheritDoc}
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getRequestBasicHeaders(): array
    {
        $headers = [];
        if ($this->isAuthenticated()) {
            $headers['Cookie'] = 'Shop5=' . $this->getToken()->getAccessToken();
        } elseif ($this->hasSession()) {
            $headers['Cookie'] = 'Shop5=' . $this->getSession();
        }
        return $headers;
    }

    public function hasSession(): bool
    {
        return (bool) $this->session;
    }

    public function getSession(): string
    {
        return $this->session;
    }

    public function setSession(string $session): void
    {
        $this->session = $session;
    }

    private function _resetSession(): void
    {
        $this->session = null;
    }

    /**
     * {@inheritdoc}
     */
    public function setToken(?TokenInterface $token): void
    {
        parent::setToken($token);
        $this->_resetSession();
    }

    public function clearSessions(): void
    {
        parent::setToken(null);
        $this->_resetSession();
    }
}