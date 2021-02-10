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

class CategoryTreeResource extends FrontResource
{
    /**
     * @param FrontShopInterface $shop
     * @param int $categoryId
     * @return DataInterface
     * @throws \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     */
    public function getTree(FrontShopInterface $shop, int $categoryId): DataInterface
    {
        return $this->execute(
            $shop,
            [],
            [
                'id' => $categoryId
            ]
        );
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
        $uri = $uri->withPath($uri->getPath() . '/categories/' . $uriData['id'] . '/tree');

        return $uri;
    }
}