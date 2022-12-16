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
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopFrontDataFactoryInterface extends FactoryInterface
{
    /**
     * @param array $data
     * @param DataInterface|null $container
     *
     * @return DataInterface
     */
    public function createFromArray(array $data, DataInterface $container = null): DataInterface;

    /**
     * @param FrontResourceInterface $resource
     * @param FrontShopInterface $shop
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ShopDataInterface
     */
    public function createByApiRequest(FrontResourceInterface $resource, FrontShopInterface $shop, RequestInterface $request, ResponseInterface $response): ShopDataInterface;
}