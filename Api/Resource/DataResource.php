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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

abstract class DataResource extends Resource implements DataResourceInterface
{
    use ShopDataTrait;

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopDataFactoryInterface $shopDataFactory
     */
    public function __construct(ShopClientInterface $shopClient = null,
                                AuthenticatorInterface $authenticator = null,
                                ShopDataFactoryInterface $shopDataFactory = null
    ) {
        $this->shopDataFactory = $shopDataFactory;

        parent::__construct($shopClient, $authenticator);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(ShopInterface $shop): ShopDataInterface
    {
        list($request, $response) = $this->perform($shop, 'GET');

        return $this->getShopDataFactory()->createByApiRequest($this, $shop, $request, $response);
    }
}