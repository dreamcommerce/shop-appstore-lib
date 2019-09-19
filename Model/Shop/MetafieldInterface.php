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

use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface MetafieldInterface extends ShopItemInterface, ResourceInterface
{
    /**
     * type of integer
     */
    const TYPE_INT = 1;

    /**
     * type of float
     */
    const TYPE_FLOAT = 2;

    /**
     * type of string
     */

    const TYPE_STRING = 3;

    /**
     * type of binary data
     */
    const TYPE_BLOB = 4;

    /**
     * @param string $key
     */
    public function setKey(string $key): void;

    /**
     * @return string|null
     */
    public function getKey(): ?string;

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void;

    /**
     * @return string|null
     */
    public function getNamespace(): ?string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $object
     */
    public function setObject(?string $object): void;

    /**
     * @return string|null
     */
    public function getObject(): ?string;

    /**
     * @return int
     */
    public function getType(): ?int;

    /**
     * @param int $type
     */
    public function setType(int $type): void;

    /**
     * @param MetafieldValueInterface $value
     */
    public function addValue(MetafieldValueInterface $value): void;

    /**
     * @param MetafieldValueInterface $value
     * @return bool
     */
    public function hasValue(MetafieldValueInterface $value): bool;

    /**
     * @param MetafieldValueInterface $value
     */
    public function removeValue(MetafieldValueInterface $value): void;

    /**
     * @return MetafieldValueInterface[]|iterable
     */
    public function getValues(): iterable;
}