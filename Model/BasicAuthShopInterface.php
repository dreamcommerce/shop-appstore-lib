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

interface BasicAuthShopInterface extends ShopInterface
{
    /**
     * @return string|null
     */
    public function getUsername(): ?string;

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void;

    /**
     * @return string|null
     */
    public function getPassword(): ?string;

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void;
}
