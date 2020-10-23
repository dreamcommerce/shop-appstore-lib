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

namespace DreamCommerce\Component\ShopAppstore\Model;

class ShopItem extends ShopData implements ShopItemInterface
{
    /**
     * @var int|null
     */
    private $externalId;

    /**
     * @param ShopInterface|null $shop
     * @param array $data
     * @param int|null $externalId
     */
    public function __construct(ShopInterface $shop = null, array $data = [], int $externalId = null)
    {
        parent::__construct($shop, $data);

        $this->externalId = $externalId;
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalId(): ?int
    {
        return $this->externalId;
    }

    /**
     * {@inheritdoc}
     */
    public function setExternalId(int $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * {@inheritdoc}
     */
    public function hasExternalId(): bool
    {
        return $this->externalId !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function flush(): void
    {
        $this->changedKeys = [];
    }
}
