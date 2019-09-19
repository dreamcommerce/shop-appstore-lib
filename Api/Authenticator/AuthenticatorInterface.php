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

namespace DreamCommerce\Component\ShopAppstore\Api\Authenticator;

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

interface AuthenticatorInterface
{
    /**
     * @param ShopInterface $shop
     * @return void
     */
    public function authenticate(ShopInterface $shop): void;

    /**
     * @param ShopInterface $shop
     */
    public function refresh(ShopInterface $shop): void;
}