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
     * @return null|string
     */
    public function getUsername(): ?string;

    /**
     * @param null|string $username
     * @return void
     */
    public function setUsername(?string $username): void;

    /**
     * @return null|string
     */
    public function getPassword(): ?string;

    /**
     * @param null|string $password
     * @return void
     */
    public function setPassword(?string $password): void;
}