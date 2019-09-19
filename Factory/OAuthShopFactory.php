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

use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\UriInterface;

class OAuthShopFactory extends ShopFactory implements OAuthShopFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): ShopInterface
    {
        /** @var OAuthShopInterface $object */
        $object = parent::createNew();
        $object->setState(OAuthShopInterface::STATE_NEW);
        $object->setBillingState(OAuthShopInterface::STATE_BILLING_UNPAID);
        $object->setVersion(0);

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public function createNewByApplicationAndUri(ApplicationInterface $application, UriInterface $uri): OAuthShopInterface
    {
        /** @var OAuthShopInterface $object */
        $object = $this->createNew();
        $object->setUri($uri);
        $object->setApplication($application);

        return $object;
    }
}
