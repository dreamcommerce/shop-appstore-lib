<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Resource\Front;

use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use Psr\Http\Message\UriInterface;

class SubscribersResource extends FrontResource
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
        $uri = parent::getUri($shop, $uriData);
        return $uri->withPath($uri->getPath() . '/subscribers');
    }
}
