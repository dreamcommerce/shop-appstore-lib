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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\BulkContainerInterface;
use DreamCommerce\Component\ShopAppstore\Api\Bulk\BulkResultInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\BulkResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopBulkFactoryInterface extends FactoryInterface
{
    /**
     * @param BulkResourceInterface $resource
     * @param BulkContainerInterface $container
     * @param ShopInterface $shop
     * @param array $data
     *
     * @return BulkResultInterface
     */
    public function createByApiResource(BulkResourceInterface $resource, BulkContainerInterface $container, ShopInterface $shop, array $data): BulkResultInterface;

    /**
     * @param BulkResourceInterface $resource
     * @param BulkContainerInterface $container
     * @param ShopInterface $shop
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return BulkResultInterface
     */
    public function createByApiRequest(BulkResourceInterface $resource, BulkContainerInterface $container, ShopInterface $shop, RequestInterface $request, ResponseInterface $response): BulkResultInterface;
}
