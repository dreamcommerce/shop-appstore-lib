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

interface MetafieldValueResourceInterface extends ResourceInterface
{
    /**
     * @param MetafieldInterface $resource
     * @param Criteria|null $criteria
     *
     * @return ShopItemListInterface|MetafieldValueInterface[]
     */
    public function findByMetafield(MetafieldInterface $resource, Criteria $criteria = null): ShopItemListInterface;

    /**
     * @param MetafieldInterface $metafield
     * @param ShopItemInterface $item
     * @param mixed $value
     *
     * @return MetafieldValueInterface
     */
    public function insertByMetafield(MetafieldInterface $metafield, ShopItemInterface $item, $value): MetafieldValueInterface;
}
