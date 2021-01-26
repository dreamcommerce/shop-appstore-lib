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
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use Psr\Http\Message\UriInterface;

abstract class ObjectHandleResource extends ItemResource implements ObjectHandleResourceInterface
{
    /**
     * @var string|null
     */
    private $currentObjectName;

    /**
     * {@inheritdoc}
     */
    public function findWithObject(ShopInterface $shop, int $id, ObjectAwareResourceInterface $resource = null): ShopItemListInterface
    {
        // TODO: Implement findWithObject() method.
    }

    /**
     * {@inheritdoc}
     */
    public function findByWithObject(ShopInterface $shop, Criteria $criteria, ObjectAwareResourceInterface $resource = null): ShopItemListInterface
    {
        $criteria = clone $criteria;
        $criteria->andWhere('object', $resource->getObjectName());

        return $this->findBy($shop, $criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function insertWithObject(ShopInterface $shop, array $data, ObjectAwareResourceInterface $resource = null): MetafieldInterface
    {
        $data['object'] = $resource->getObjectName();
        $this->currentObjectName = $data['object'];

        $result = $this->insert($shop, $data);
        $this->currentObjectName = $this->getDefaultObjectName();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function updateWithObject(ShopInterface $shop, int $id, array $data, ObjectAwareResourceInterface $resource = null): ShopItemListInterface
    {
        // TODO: Implement updateWithObject() method.
    }

    /**
     * {@inheritdoc}
     */
    public function deleteWithObject(ShopInterface $shop, int $id, ObjectAwareResourceInterface $resource = null): ShopItemListInterface
    {
        // TODO: Implement deleteWithObject() method.
    }

    /**
     * {@inheritdoc}
     */
    public function findByPartial(ShopInterface $shop, Criteria $criteria): ShopItemPartListInterface
    {
        $where = $criteria->getWhereExpression();
        if (isset($where['object'], $where['object']['='])) {
            $this->currentObjectName = $where['object']['='];
        }

        $result = parent::findByPartial($shop, $criteria);
        $this->currentObjectName = $this->getDefaultObjectName();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function insert(ShopInterface $shop, array $data): ShopItemInterface
    {
        if (!isset($data['object'])) {
            $data['object'] = $this->getDefaultObjectName();
        }
        $this->currentObjectName = $data['object'];

        $result = parent::insert($shop, $data);
        $this->currentObjectName = $this->getDefaultObjectName();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update(ShopInterface $shop, int $id, array $data): void
    {
        if (isset($data['object'])) {
            $this->currentObjectName = $data['object'];
        }

        parent::update($shop, $id, $data);
        $this->currentObjectName = $this->getDefaultObjectName();
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ShopItemInterface $shopItem, array $data = null): void
    {
        if ($shopItem instanceof MetafieldInterface) {
            $data['object'] = $shopItem->getObject();
        }

        parent::updateItem($shopItem, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem(ShopItemInterface $shopItem): void
    {
        if ($shopItem instanceof MetafieldInterface) {
            $this->currentObjectName = $shopItem->getObject();
        }

        parent::deleteItem($shopItem);
        $this->currentObjectName = $this->getDefaultObjectName();
    }

    /**
     * {@inheritdoc}
     */
    protected function getUri(ShopInterface $shop, int $id = null, string $name = null, string $objectName = null): UriInterface
    {
        if($objectName === null) {
            $objectName = $this->currentObjectName;
        }

        return parent::getUri($shop, $id, $name, $objectName);
    }

    /**
     * @return string|null
     */
    protected function getDefaultObjectName(): ?string
    {
        return null;
    }
}
