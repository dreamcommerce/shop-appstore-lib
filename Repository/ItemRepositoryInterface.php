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

namespace DreamCommerce\Component\ShopAppstore\Repository;

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @param ShopInterface $shop
     *
     * @return iterable
     */
    public function findByShop(ShopInterface $shop): iterable;

    /**
     * @param ShopInterface $shop
     * @param int $externalId
     *
     * @return iterable
     */
    public function findByShopAndExternalId(ShopInterface $shop, int $externalId): iterable;
}
