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

use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;

interface MetafieldResourceInterface extends ResourceInterface
{
    /**
     * @param ObjectAwareInterface $resource
     * @param ShopInterface $shop
     * @param array $data
     *
     * @return MetafieldInterface
     */
    public function insertByResource(ObjectAwareInterface $resource, ShopInterface $shop, array $data): MetafieldInterface;

    /**
     * @param ObjectAwareInterface $resource
     * @param ShopInterface $shop
     * @param Criteria|null $criteria
     *
     * @return ShopItemListInterface|MetafieldInterface[]
     */
    public function findByResource(ObjectAwareInterface $resource, ShopInterface $shop, Criteria $criteria = null): ShopItemListInterface;
}
