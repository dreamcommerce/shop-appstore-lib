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

namespace DreamCommerce\Component\ShopAppstore\Api;

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartList;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\ResponseInterface;

abstract class ItemResource extends Resource implements ItemResourceInterface
{
    /**
     * @var ShopItemFactoryInterface|null
     */
    private $shopItemFactory;

    /**
     * @var ShopItemPartListFactoryInterface|null
     */
    private $shopItemListFactory;

    /**
     * @var ShopItemPartListInterface|null
     */
    private $shopItemPartListFactory;

    /**
     * @var ShopItemFactoryInterface|null
     */
    private static $globalItemFactory;

    /**
     * @var ShopItemListFactoryInterface|null
     */
    private static $globalItemListFactory;

    /**
     * @var ShopItemPartListFactoryInterface|null
     */
    private static $globalItemPartListFactory;

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopItemFactoryInterface $shopItemFactory
     * @param ShopItemPartListFactoryInterface|null $shopItemPartListFactory
     * @param ShopItemListFactoryInterface|null $shopItemListFactory
     */
    public function __construct(ShopClientInterface $shopClient = null,
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
    public function find(ShopInterface $shop, int $id): ShopItemInterface
    {
        list($request, $response) = $this->perform($shop, 'GET', $id);

        return $this->getShopItemFactory()->createByApiRequest($this, $shop, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(ShopInterface $shop, Criteria $criteria): ShopItemListInterface
    {
        $criteria = clone $criteria;
        $criteria->rewind();

        /** @var ShopItemListInterface $itemList */
        $itemList = $this->getShopItemListFactory()->createByApiResource($this, $shop);
        $this->resume($itemList, $criteria);

        return $itemList;
    }

    /**
     * {@inheritdoc}
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria): ShopItemPartListInterface
    {
        list($request, $response) = $this->perform($shop,'GET',null, null, $criteria);

        return $this->getShopItemPartListFactory()->createByApiRequest($this, $shop, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(ShopInterface $shop): ShopItemListInterface
    {
        return $this->findBy($shop, Criteria::create());
    }

    /**
     * {@inheritdoc}
     */
    public function resume(ShopItemListInterface $itemList, Criteria $criteria): void
    {
        $this->fetchAll($itemList->getShop(), $criteria, function(ShopItemPartList $itemPartList) use($itemList) {
            $itemList->addPart($itemPartList);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function walk(ShopInterface $shop, callable $callback, Criteria $criteria = null): void
    {
        if($criteria === null) {
            $criteria = Criteria::create();
        } else {
            $criteria = clone $criteria;
            $criteria->rewind();
        }

        $this->fetchAll($shop, $criteria, function(ShopItemPartList $itemPartList) use($callback) {
            foreach($itemPartList as $item) {
                call_user_func($callback, $item);
            }
        });
    }

    /**
     * {@inheritdoc}
     */
    public function insert(ShopInterface $shop, array $data): ShopItemInterface
    {
        /** @var ResponseInterface $response */
        list(, $response) = $this->perform($shop, 'POST', null, $data);
        $stream = $response->getBody();
        $stream->rewind();
        $id = trim($stream->getContents(), '"');

        $item = $this->getShopItemFactory()->createByApiResource($this, $shop, $data);
        $item->setExternalId((int)$id);

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function update(ShopInterface $shop, int $id, array $data): void
    {
        $this->perform($shop, 'PUT', $id, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ShopInterface $shop, int $id): void
    {
        $this->perform($shop, 'DELETE', $id);
    }

    /**
     * {@inheritdoc}
     */
    public function reattach(ShopItemInterface $shopItem): void
    {
        $actualItem = $this->find($shopItem->getShop(), $shopItem->getExternalId());
        $shopItem->setData($actualItem->getData());
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function insertItem(ShopItemInterface $shopItem): void
    {
        if($shopItem->hasExternalId()) {
            // TODO throw exception
        }

        $shopItemResult = $this->insert($shopItem->getShop(), $shopItem->getData());
        $shopItem->setExternalId($shopItemResult->getExternalId());
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ShopItemInterface $shopItem, array $data = null): void
    {
        if(!$shopItem->hasExternalId()) {
            // TODO throw exception
        }

        if($data === null) {
            $data = $shopItem->getDiffData();
        }

        $this->update($shopItem->getShop(), $shopItem->getExternalId(), $data);
        $shopItem->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem(ShopItemInterface $shopItem): void
    {
        if(!$shopItem->hasExternalId()) {
            // TODO throw exception
        }

        $this->delete($shopItem->getShop(), $shopItem->getExternalId());
    }

    /**
     * @param ShopInterface $shop
     * @param Criteria $criteria
     * @param callable $callback
     */
    protected function fetchAll(ShopInterface $shop, Criteria $criteria, callable $callback)
    {
        do {
            try {
                $itemPartList = $this->findByPartial($shop, $criteria);
            } catch(LimitExceededException $exception) {
                // TODO throw
            }
            call_user_func($callback, $itemPartList);
            $criteria->nextPage();
        } while($criteria->getPage() <= $itemPartList->getTotalPages());
    }

    /**
     * @return ShopItemFactoryInterface
     */
    protected function getShopItemFactory(): ShopItemFactoryInterface
    {
        if($this->shopItemFactory !== null) {
            return $this->shopItemFactory;
        }

        if(self::$globalItemFactory === null) {
            self::$globalItemFactory = new ShopItemFactory($this->getGlobalDataFactory());
        }

        return self::$globalItemFactory;
    }

    /**
     * @return ShopItemListFactoryInterface
     */
    protected function getShopItemListFactory(): ShopItemListFactoryInterface
    {
        if($this->shopItemListFactory !== null) {
            return $this->shopItemListFactory;
        }

        if(self::$globalItemListFactory === null) {
            self::$globalItemListFactory = new ShopItemListFactory();
        }

        return self::$globalItemListFactory;
    }

    /**
     * @return ShopItemPartListFactoryInterface
     */
    protected function getShopItemPartListFactory(): ShopItemPartListFactoryInterface
    {
        if($this->shopItemPartListFactory !== null) {
            return $this->shopItemPartListFactory;
        }

        if(self::$globalItemPartListFactory === null) {
            self::$globalItemPartListFactory = new ShopItemPartListFactory($this->getShopItemFactory());
        }

        return self::$globalItemPartListFactory;
    }
}