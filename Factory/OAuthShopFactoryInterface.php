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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use Psr\Http\Message\UriInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface OAuthShopFactoryInterface extends FactoryInterface
{
    /**
     * @param ApplicationInterface $application
     * @param UriInterface $uri
     *
     * @return OAuthShopInterface
     */
    public function createNewByApplicationAndUri(ApplicationInterface $application, UriInterface $uri): OAuthShopInterface;
}
