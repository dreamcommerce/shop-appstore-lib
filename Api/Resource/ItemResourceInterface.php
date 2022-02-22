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
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;

interface ItemResourceInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getExternalIdName(): string;

    /**
     * @param ShopInterface $shop
     * @param int $id
     *
     * @return ShopItemInterface
     */
    public function find(ShopInterface $shop, int $id, array $uriParameters = []): ShopItemInterface;

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     *
     * @return ShopItemListInterface|ShopItemInterface[]
     */
    public function findBy(ShopInterface $shop, Criteria $criteria, array $uriParameters = []): ShopItemListInterface;

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     *
     * @return ShopItemPartListInterface|ShopItemInterface[]
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria, array $uriParameters = []): ShopItemPartListInterface;

    /**
     * @param ShopInterface $shop
     *
     * @return ShopItemListInterface|ShopItemInterface[]
     */
    public function findAll(ShopInterface $shop, array $uriParameters = []): ShopItemListInterface;

    /**
     * @param ShopItemListInterface $itemList
     * @param Criteria $criteria
     */
    public function resume(ShopItemListInterface $itemList, Criteria $criteria, array $uriParameters = []): void;

    /**
     * @param ShopInterface $shop
     * @param callable $callback
     * @param Criteria|null $criteria
     */
    public function walk(ShopInterface $shop, callable $callback, Criteria $criteria = null, array $uriParameters = []): void;

    /**
     * @param ShopInterface $shop
     * @param array $data
     *
     * @return ShopItemInterface
     */
    public function insert(ShopInterface $shop, array $data, array $uriParameters = []): ShopItemInterface;

    /**
     * @param ShopInterface $shop
     * @param int $id
     * @param array $data
     */
    public function update(ShopInterface $shop, int $id, array $data, array $uriParameters = []): void;

    /**
     * @param ShopInterface $shop
     * @param int $id
     */
    public function delete(ShopInterface $shop, int $id, array $uriParameters = []): void;

    /**
     * @param ShopItemInterface $shopItem
     */
    public function reattach(ShopItemInterface $shopItem, array $uriParameters = []): void;

    /**
     * @param ShopItemInterface $item
     */
    public function insertItem(ShopItemInterface $item, array $uriParameters = []): void;

    /**
     * @param ShopItemInterface $item
     * @param array|null $data
     */
    public function updateItem(ShopItemInterface $item, array $data = null, array $uriParameters = []): void;

    /**
     * @param ShopItemInterface $item
     */
    public function deleteItem(ShopItemInterface $item, array $uriParameters = []): void;
}
