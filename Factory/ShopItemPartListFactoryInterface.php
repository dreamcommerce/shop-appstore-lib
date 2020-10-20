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

use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopItemPartListFactoryInterface extends FactoryInterface
{
    /**
     * @param ItemResourceInterface $resource
     * @param ShopInterface $shop
     * @param array $data
     * @return ShopItemPartListInterface
     */
    public function createByApiResource(ItemResourceInterface $resource, ShopInterface $shop,
                                        array $data): ShopItemPartListInterface;

    /**
     * @param ItemResourceInterface $resource
     * @param ShopInterface $shop
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ShopItemPartListInterface
     */
    public function createByApiRequest(ItemResourceInterface $resource, ShopInterface $shop,
                                       RequestInterface $request, ResponseInterface $response): ShopItemPartListInterface;
}