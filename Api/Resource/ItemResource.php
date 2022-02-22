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
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartList;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use Psr\Http\Message\ResponseInterface;

abstract class ItemResource extends Resource implements ItemResourceInterface
{
    use ShopItemTrait;

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopItemFactoryInterface $shopItemFactory
     * @param ShopItemPartListFactoryInterface|null $shopItemPartListFactory
     * @param ShopItemListFactoryInterface|null $shopItemListFactory
     */
    public function __construct(
        ShopClientInterface $shopClient = null,
        AuthenticatorInterface $authenticator = null,
        ShopItemFactoryInterface $shopItemFactory = null,
        ShopItemPartListFactoryInterface $shopItemPartListFactory = null,
        ShopItemListFactoryInterface $shopItemListFactory = null
    ) {
        $this->shopItemFactory = $shopItemFactory;
        $this->shopItemPartListFactory = $shopItemPartListFactory;
        $this->shopItemListFactory = $shopItemListFactory;


        parent::__construct($shopClient, $authenticator);
    }

    /**
     * {@inheritdoc}
     */
    public function find(ShopInterface $shop, int $id, array $uriParameters = []): ShopItemInterface
    {
        [$request, $response] = $this->perform($shop, 'GET', $id, null, null, $uriParameters);

        return $this->getShopItemFactory()->createByApiRequest($this, $shop, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(ShopInterface $shop, Criteria $criteria, array $uriParameters = []): ShopItemListInterface
    {
        $criteria = clone $criteria;
        $criteria->rewind();

        /** @var ShopItemListInterface $itemList */
        $itemList = $this->getShopItemListFactory()->createByApiResource($this, $shop);
        $this->resume($itemList, $criteria, $uriParameters);

        return $itemList;
    }

    /**
     * {@inheritdoc}
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria, array $uriParameters = []): ShopItemPartListInterface
    {
        [$request, $response] = $this->perform($shop, 'GET', null, null, $criteria, $uriParameters);

        return $this->getShopItemPartListFactory()->createByApiRequest($this, $shop, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(ShopInterface $shop, array $uriParameters = []): ShopItemListInterface
    {
        return $this->findBy($shop, Criteria::create(), $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function resume(ShopItemListInterface $itemList, Criteria $criteria, array $uriParameters = []): void
    {
        $this->fetchAll($itemList->getShop(), $criteria, function (ShopItemPartList $itemPartList) use ($itemList) {
            $itemList->addPart($itemPartList);
        }, $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function walk(ShopInterface $shop, callable $callback, Criteria $criteria = null, array $uriParameters = []): void
    {
        if ($criteria === null) {
            $criteria = Criteria::create();
        } else {
            $criteria = clone $criteria;
            $criteria->rewind();
        }

        $this->fetchAll($shop, $criteria, function (ShopItemPartList $itemPartList) use ($callback) {
            foreach ($itemPartList as $item) {
                call_user_func($callback, $item);
            }
        }, $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function insert(ShopInterface $shop, array $data, array $uriParameters = []): ShopItemInterface
    {
        /** @var ResponseInterface $response */
        [, $response] = $this->perform($shop, 'POST', null, $data, null, $uriParameters);
        $stream = $response->getBody();
        $stream->rewind();
        $id = trim($stream->getContents(), '"');

        $item = $this->getShopItemFactory()->createByApiResource($this, $shop, $data);
        $item->setExternalId((int) $id);

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function update(ShopInterface $shop, int $id, array $data, array $uriParameters = []): void
    {
        $this->perform($shop, 'PUT', $id, $data, null, $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ShopInterface $shop, int $id, array $uriParameters = []): void
    {
        $this->perform($shop, 'DELETE', $id, null, null, $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function reattach(ShopItemInterface $shopItem, array $uriParameters = []): void
    {
        $actualItem = $this->find($shopItem->getShop(), $shopItem->getExternalId(), $uriParameters);
        $this->getShopItemFactory()->createFromArray($actualItem->getData(), $shopItem);
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function insertItem(ShopItemInterface $shopItem, array $uriParameters = []): void
    {
        if ($shopItem->hasExternalId()) {
            // TODO throw exception
        }

        $shopItemResult = $this->insert($shopItem->getShop(), $shopItem->getData(), $uriParameters);
        $shopItem->setExternalId($shopItemResult->getExternalId());
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ShopItemInterface $shopItem, array $data = null, array $uriParameters = []): void
    {
        if (!$shopItem->hasExternalId()) {
            // TODO throw exception
        }

        if ($data === null) {
            $data = $shopItem->getDiffData();
        }

        $this->update($shopItem->getShop(), $shopItem->getExternalId(), $data, $uriParameters);
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem(ShopItemInterface $shopItem, array $uriParameters = []): void
    {
        if (!$shopItem->hasExternalId()) {
            // TODO throw exception
        }

        $this->delete($shopItem->getShop(), $shopItem->getExternalId(), $uriParameters);
    }

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     * @param callable $callback
     */
    protected function fetchAll(ShopInterface $shop, Criteria $criteria, callable $callback, array $uriParameters = [])
    {
        do {
            try {
                $itemPartList = $this->findByPartial($shop, $criteria, $uriParameters);
            } catch (LimitExceededException $exception) {
                // TODO throw
            }
            call_user_func($callback, $itemPartList);
            $criteria->nextPage();
        } while ($criteria->getPage() <= $itemPartList->getTotalPages());
    }
}
