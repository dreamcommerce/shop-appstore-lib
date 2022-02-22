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
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValueInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use Webmozart\Assert\Assert;

class MetafieldValueResource extends ItemResource implements MetafieldValueResourceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'metafield-values';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'value_id';
    }

    /**
     * {@inheritdoc}
     */
    public function findByMetafield(MetafieldInterface $resource, Criteria $criteria = null): ShopItemListInterface
    {
        if ($criteria === null) {
            $criteria = Criteria::create();
        } else {
            $criteria = clone $criteria;
        }
        $criteria->andWhere('metafield_id', $resource->getExternalId());

        return $this->findBy($resource->getShop(), $criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function insertWithObjectValue(MetafieldInterface $metafield, ShopItemInterface $item, $value): MetafieldValueInterface
    {
        $data = [
            'metafield_id' => $metafield->getExternalId(),
            'object_id' => $item->getExternalId(),
            'value' => $value,
            'type' => $metafield->getType()
        ];

        $value = $this->insert($metafield->getShop(), $data);
        $metafield->addValue($value);

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function insertWithValue(MetafieldInterface $metafield, $value): MetafieldValueInterface
    {
        $data = [
            'metafield_id' => $metafield->getExternalId(),
            'value' => $value,
            'type' => $metafield->getType()
        ];

        $value = $this->insert($metafield->getShop(), $data);
        $metafield->addValue($value);

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function updateItem(ShopItemInterface $shopItem, array $data = null, array $uriParameters = []): void
    {
        Assert::isInstanceOf($shopItem, MetafieldInterface::class);

        parent::updateItem($shopItem, $data, $uriParameters);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem(ShopItemInterface $shopItem, array $uriParameters = []): void
    {
        Assert::isInstanceOf($shopItem, MetafieldInterface::class);

        parent::deleteItem($shopItem, $uriParameters);
    }
}
