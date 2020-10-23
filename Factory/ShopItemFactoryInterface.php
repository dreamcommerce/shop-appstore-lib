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
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopItemFactoryInterface extends FactoryInterface
{
    /**
     * @param array $data
     * @param DataInterface|null $container
     *
     * @return DataInterface
     */
    public function createFromArray(array $data, DataInterface $container = null): DataInterface;

    /**
     * @param ItemResourceInterface $resource
     * @param ShopInterface $shop
     * @param array $data
     *
     * @return ShopItemInterface
     */
    public function createByApiResource(ItemResourceInterface $resource, ShopInterface $shop, array $data): ShopItemInterface;

    /**
     * @param ItemResourceInterface $resource
     * @param ShopInterface $shop
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ShopItemInterface
     */
    public function createByApiRequest(
        ItemResourceInterface $resource,
        ShopInterface $shop,
        RequestInterface $request,
        ResponseInterface $response
    ): ShopItemInterface;
}
