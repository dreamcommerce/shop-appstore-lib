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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource\Front;

use DreamCommerce\Component\Common\Exception\NotDefinedException;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use Psr\Http\Message\UriInterface;

class UserFavouritesInfoResource extends FrontResource
{
    /**
     * {@inheritDoc}
     */
    public function isPublic(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(FrontShopInterface $shop, array $uriData): UriInterface
    {
        if(!isset($uriData['id'])) {
            throw NotDefinedException::forParameter('id');
        }

        $uri = parent::getUri($shop, $uriData);

        return $uri->withPath($uri->getPath() . '/user/favourites/' . $uriData['id']);
    }
}