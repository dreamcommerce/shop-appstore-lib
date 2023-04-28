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
use DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException;
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use Psr\Http\Message\UriInterface;

class ProductSearchResource extends FrontResource
{
    /**
     * @param FrontShopInterface $shop
     * @param string $query
     * @param string $currencyName
     * @return DataInterface
     * @throws CommunicationException
     */
    public function getProducts(FrontShopInterface $shop, string $query, string $currencyName): DataInterface
    {
        return $this->execute(
            $shop, [],
            [
                'currency' => $currencyName,
                'searchquery' => $query,
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(FrontShopInterface $shop, array $uriData): UriInterface
    {
        $params = ['searchquery', 'currency'];
        foreach ($params as $param) {
            if (!isset($uriData[$param])) {
                throw NotDefinedException::forParameter($param);
            }
        }

        $uri = parent::getUri($shop, $uriData);
        $uri = $uri->withPath(
            $uri->getPath() . '/products/' . $uriData['currency'] . '/search/' . $uriData['searchquery']
        );

        return $uri;
    }
}