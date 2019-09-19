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

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class ShopFactory implements FactoryInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var FactoryInterface
     */
    protected $tokenFactory;

    /**
     * @param FactoryInterface $factory
     * @param FactoryInterface $tokenFactory
     */
    public function __construct(FactoryInterface $factory, FactoryInterface $tokenFactory)
    {
        $this->factory = $factory;
        $this->tokenFactory = $tokenFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): ShopInterface
    {
        /** @var ShopInterface $object */
        $object = $this->factory->createNew();

        /** @var TokenInterface $token */
        $token = $this->tokenFactory->createNew();
        $object->setToken($token);

        return $object;
    }
}
