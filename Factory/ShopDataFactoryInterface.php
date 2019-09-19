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

use DreamCommerce\Component\ShopAppstore\Api\DataResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopDataFactoryInterface extends FactoryInterface
{
    /**
     * @param DataResourceInterface $resource
     * @param ShopInterface $shop
     * @param array $data
     * @return ShopDataInterface
     */
    public function createByApiResource(DataResourceInterface $resource, ShopInterface $shop, array $data): ShopDataInterface;

    /**
     * @param DataResourceInterface $resource
     * @param ShopInterface $shop
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ShopDataInterface
     */
    public function createByApiRequest(DataResourceInterface $resource, ShopInterface $shop, RequestInterface $request, ResponseInterface $response): ShopDataInterface;
}