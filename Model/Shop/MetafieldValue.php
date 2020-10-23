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

use DreamCommerce\Component\ShopAppstore\Model\ShopItem;

abstract class MetafieldValue extends ShopItem implements MetafieldValueInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $objectId;

    /**
     * @var MetafieldInterface
     */
    protected $metafield;

    /**
     * {@inheritdoc}
     */
    public static function getMapClass(): array
    {
        return [
            0 => MetafieldValueString::class, // default, backward compatibility
            MetafieldInterface::TYPE_INT => MetafieldValueInt::class,
            MetafieldInterface::TYPE_FLOAT => MetafieldValueFloat::class,
            MetafieldInterface::TYPE_STRING => MetafieldValueString::class,
            MetafieldInterface::TYPE_BLOB => MetafieldValueBlob::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getMapField(): string
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectId(): ?int
    {
        return $this->objectId;
    }

    /**
     * {@inheritdoc}
     */
    public function setObjectId(int $objectId): void
    {
        $this->objectId = $objectId;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetafield(): ?MetafieldInterface
    {
        return $this->metafield;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetafield(MetafieldInterface $metafield): void
    {
        $metafieldType = $metafield->getType();
        $mapClass = self::getMapClass()[$metafieldType];

        if (static::class !== $mapClass) {
            // TODO
//            throw new MetafieldTypeException(
//                sprintf('Metafield accept only values that are instance of %s. You are trying set instance of %s', $mapClass, static::class)
//            );
        }

        $this->metafield = $metafield;
    }
}
