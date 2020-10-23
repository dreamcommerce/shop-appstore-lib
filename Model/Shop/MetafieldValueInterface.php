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

namespace DreamCommerce\Component\ShopAppstore\Model\Shop;

use DreamCommerce\Component\ShopAppstore\Model\DiscriminatorMappingInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface MetafieldValueInterface extends ShopItemInterface, ResourceInterface, DiscriminatorMappingInterface
{
    /**
     * @return int
     */
    public function getType(): int;

    /**
     * @return int|null
     */
    public function getObjectId(): ?int;

    /**
     * @param int $id
     */
    public function setObjectId(int $id): void;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     */
    public function setValue($value): void;

    /**
     * @return MetafieldInterface|null
     */
    public function getMetafield(): ?MetafieldInterface;

    /**
     * @param MetafieldInterface $metafield
     */
    public function setMetafield(MetafieldInterface $metafield): void;
}
