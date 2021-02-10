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
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use Psr\Http\Message\UriInterface;

class ProductNewListResource extends FrontResource
{
    /**
     * @param FrontShopInterface $shop
     * @param int $categoryId
     * @param string $currencyName
     * @return DataInterface
     * @throws \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     */
    public function getProducts(FrontShopInterface $shop, string $currencyName): DataInterface
    {
        return $this->execute(
            $shop,
            [],
            [
                'currency' => $currencyName
            ]
        );
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
        $uri = $uri->withPath($uri->getPath() . '/products/' . $uriData['currency'] . '/news');

        return $uri;
    }
}