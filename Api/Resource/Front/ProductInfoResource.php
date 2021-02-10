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

class ProductInfoResource extends FrontResource
{
    /**
     * @param FrontShopInterface $shop
     * @param int $productId
     * @param string $currency
     * @return DataInterface
     * @throws \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     */
    public function getProduct(FrontShopInterface $shop, int $productId, string $currency): DataInterface
    {
        return $this->execute(
            $shop,
            [],
            [
                'id' => $productId,
                'currency' => $currency
            ]
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
        $uri = $uri->withPath($uri->getPath() . '/products/' . $uriData['currency'] . '/' . $uriData['id']);

        return $uri;
    }
}