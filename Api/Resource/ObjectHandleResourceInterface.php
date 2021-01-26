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

interface ObjectHandleResourceInterface extends ResourceInterface
{
    /**
     * @param ShopInterface $shop
     * @param int $id
     * @param ObjectAwareResourceInterface|null $resource
     * @return ShopItemListInterface
     */
    public function findWithObject(ShopInterface $shop, int $id, ObjectAwareResourceInterface $resource = null): ShopItemListInterface;

    /**
     * @param ShopInterface $shop
     * @param Criteria|null $criteria
     * @param ObjectAwareResourceInterface|null $resource
     * @return ShopItemListInterface
     */
    public function findByWithObject(ShopInterface $shop, Criteria $criteria, ObjectAwareResourceInterface $resource = null): ShopItemListInterface;

    /**
     * @param ShopInterface $shop
     * @param array $data
     * @param ObjectAwareResourceInterface|null $resource
     * @return MetafieldInterface
     */
    public function insertWithObject(ShopInterface $shop, array $data, ObjectAwareResourceInterface $resource = null): MetafieldInterface;

    /**
     * @param ShopInterface $shop
     * @param int $id
     * @param array $data
     * @param ObjectAwareResourceInterface|null $resource
     * @return ShopItemListInterface
     */
    public function updateWithObject(ShopInterface $shop, int $id, array $data, ObjectAwareResourceInterface $resource = null): ShopItemListInterface;

    /**
     * @param ShopInterface $shop
     * @param int $id
     * @param ObjectAwareResourceInterface|null $resource
     * @return ShopItemListInterface
     */
    public function deleteWithObject(ShopInterface $shop, int $id, ObjectAwareResourceInterface $resource = null): ShopItemListInterface;
}
