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

class BasketPostResource extends FrontResource
{
    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(FrontShopInterface $shop, array $uriData): UriInterface
    {
        if (!isset($uriData['currency'])) {
            throw NotDefinedException::forParameter('currency');
        }

        $uri = parent::getUri($shop, $uriData);
        $uri = $uri->withPath($uri->getPath() . '/basket/' . $uriData['currency']);

        return $uri;
    }
}