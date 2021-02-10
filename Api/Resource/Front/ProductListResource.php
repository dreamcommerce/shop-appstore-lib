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

class ProductListResource extends FrontResource
{
    const ORDER_PRODUCT_PRIORITY = 1;
    const ORDER_PRODUCT_NAME_DESC = 2;
    const ORDER_PRODUCT_PRICE_ASC = 3;
    const ORDER_PRODUCT_PRICE_DESC = 4;
    const ORDER_SEARCH_RELEVANCE = 5; // default

    /**
     * @param FrontShopInterface $shop
     * @param int $categoryId
     * @param string $currencyName
     * @param string[] $queryParameters
     * @return DataInterface
     * @throws \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     */
    public function getProducts(FrontShopInterface $shop, int $categoryId, string $currencyName, array $queryParameters = array()): DataInterface
    {
        return $this->execute(
            $shop,
            [],
            [
                'id' => $categoryId,
                'currency' => $currencyName
            ],
            $queryParameters
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function getUri(FrontShopInterface $shop, array $uriData): UriInterface
    {
        $params = ['id', 'currency'];
        foreach($params as $param) {
            if (!isset($uriData[$param])) {
                throw NotDefinedException::forParameter($param);
            }
        }

        $uri = parent::getUri($shop, $uriData);
        $uri = $uri->withPath($uri->getPath() . '/categories/' . $uriData['id'] . '/products/' . $uriData['currency']);

        return $uri;
    }
}