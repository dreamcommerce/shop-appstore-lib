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

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItem;

class Metafield extends ShopItem implements MetafieldInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $object;

    /**
     * @var int
     */
    private $type = self::TYPE_STRING;

    /**
     * @var Collection|MetafieldValueInterface[]
     */
    private $_values;

    /**
     * @param ShopInterface|null $shop
     * @param array $data
     * @param int|null $externalId
     */
    public function __construct(ShopInterface $shop = null, array $data = [], int $externalId = null)
    {
        parent::__construct($shop, $data);

        $this->_values = new ArrayCollection();
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
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setObject(?string $object): void
    {
        $this->object = $object;
    }

    /**
     * {@inheritdoc}
     */
    public function getObject(): ?string
    {
        return $this->object;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?int
    {
        return (int) $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(MetafieldValueInterface $value): void
    {
        if (!$this->hasValue($value)) {
            $this->_values->add($value);
            $value->setMetafield($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(MetafieldValueInterface $value): bool
    {
        return $this->_values->contains($value);
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(MetafieldValueInterface $value): void
    {
        if($this->hasValue($value)) {
            $this->_values->removeElement($value);
            $value->setMetafield(null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getValues(): iterable
    {
        return $this->_values;
    }
}
