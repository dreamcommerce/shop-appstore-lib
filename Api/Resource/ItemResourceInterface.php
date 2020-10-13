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
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

interface ItemResourceInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getExternalIdName(): string;

    /**
     * @param ShopInterface $shop
     * @param int $id
     * @return ShopItemInterface
     */
    public function find(ShopInterface $shop, int $id): ShopItemInterface;

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     * @return ShopItemListInterface|ShopItemInterface[]
     */
    public function findBy(ShopInterface $shop, Criteria $criteria): ShopItemListInterface;

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     * @return ShopItemPartListInterface|ShopItemInterface[]
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria): ShopItemPartListInterface;

    /**
     * @param ShopInterface $shop
     * @return ShopItemListInterface|ShopItemInterface[]
     */
    public function findAll(ShopInterface $shop): ShopItemListInterface;

    /**
     * @param ShopItemListInterface $itemList
     * @param Criteria $criteria
     */
    public function resume(ShopItemListInterface $itemList, Criteria $criteria): void;

    /**
     * @param ShopInterface $shop
     * @param callable $callback
     * @param Criteria|null $criteria
     */
    public function walk(ShopInterface $shop, callable $callback, Criteria $criteria = null): void;

    /**
     * @param ShopInterface $shop
     * @param array $data
     * @return ShopItemInterface
     */
    public function insert(ShopInterface $shop, array $data): ShopItemInterface;

    /**
     * @param ShopInterface $shop
     * @param int $id
     * @param array $data
     */
    public function update(ShopInterface $shop, int $id, array $data): void;

    /**
     * @param ShopInterface $shop
     * @param int $id
     */
    public function delete(ShopInterface $shop, int $id): void;

    /**
     * @param ShopItemInterface $shopItem
     */
    public function reattach(ShopItemInterface $shopItem): void;

    /**
     * @param ShopItemInterface $item
     */
    public function insertItem(ShopItemInterface $item): void;

    /**
     * @param ShopItemInterface $item
     * @param array|null $data
     */
    public function updateItem(ShopItemInterface $item, array $data = null): void;

    /**
     * @param ShopItemInterface $item
     */
    public function deleteItem(ShopItemInterface $item): void;
}