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

use Psr\Http\Message\UriInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface ShopInterface extends ResourceInterface, TimestampableInterface
{
    /**
     * @param UriInterface|string $uri
     */
    public function setUri($uri): void;

    /**
     * @return UriInterface|null
     */
    public function getUri(): ?UriInterface;

    /**
     * @return TokenInterface|null
     */
    public function getToken(): ?TokenInterface;

    /**
     * @param TokenInterface $token
     */
    public function setToken(?TokenInterface $token): void;

    /**
     * @return bool
     */
    public function isAuthenticated(): bool;
}
