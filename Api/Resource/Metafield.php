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
use DreamCommerce\Component\ShopAppstore\Api\ItemResource;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use Psr\Http\Message\UriInterface;

final class Metafield extends ItemResource implements ObjectAwareInterface
{
    /**
     * @var string|null
     */
    private $urlPart;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'metafields';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'metafield_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'system';
    }

    /**
     * @param ObjectAwareInterface $resource
     * @param ShopInterface $shop
     * @param array $data
     * @return MetafieldInterface
     */
    public function insertByResource(ObjectAwareInterface $resource, ShopInterface $shop, array $data): MetafieldInterface
    {
        $data['object'] = $resource->getObjectName();
        $this->urlPart = $data['object'];

        return $this->insert($shop, $data);
    }

    /**
     * @param ObjectAwareInterface $resource
     * @param ShopInterface $shop
     * @param Criteria|null $criteria
     * @return ShopItemListInterface|MetafieldInterface[]
     */
    public function findByResource(ObjectAwareInterface $resource, ShopInterface $shop, Criteria $criteria = null): ShopItemListInterface
    {
        if($criteria === null) {
            $criteria = Criteria::create();
        } else {
            $criteria = clone $criteria;
        }
        $criteria->andWhere('object', $resource->getObjectName());

        return $this->findBy($shop, $criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria): ShopItemPartListInterface
    {
        $where = $criteria->getWhereExpression();
        if(isset($where['object']) && isset($where['object']['='])) {
            $this->urlPart = $where['object']['='];
        }

        return parent::findByPartial($shop, $criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function insert(ShopInterface $shop, array $data): ShopItemInterface
    {
        if(!isset($data['object'])) {
            $data['object'] = $this->getObjectName();
        }
        $this->urlPart = $data['object'];

        $result = parent::insert($shop, $data);
        $this->urlPart = null;

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update(ShopInterface $shop, int $id, array $data): void
    {
        if(isset($data['object'])) {
            $this->urlPart = $data['object'];
        }

        parent::update($shop, $id, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ShopItemInterface $shopItem, array $data = null): void
    {
        if($shopItem instanceof MetafieldInterface) {
            $data['object'] = $shopItem->getObject();
        }

        parent::updateItem($shopItem, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function getUri(ShopInterface $shop, int $id = null): UriInterface
    {
        $uri = parent::getUri($shop, $id);
        $uri = $uri->withPath($uri->getPath() . '/' . (($this->urlPart === null) ? $this->getObjectName() : $this->urlPart));
        $this->urlPart = null;

        return $uri;
    }
}