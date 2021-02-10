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

use DreamCommerce\Component\ShopAppstore\Api\Resource\Front\FrontResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopData;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ShopFrontDataFactory extends AbstractFactory implements ShopFrontDataFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new ShopData();
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiRequest(FrontResourceInterface $resource, FrontShopInterface $shop, RequestInterface $request, ResponseInterface $response): ShopDataInterface
    {
        $data = $this->handleApiRequest($request, $response);

        $class = get_class($resource);
        if (isset($this->resourceMap[$class])) {
            $item = new $this->resourceMap[$class]();
        } else {
            $item = $this->createNew();
        }

        $item->setShop($shop);
        $this->createFromArray($data, $item);

        return $item;
    }
}
