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

interface ShopItemInterface extends ShopDataInterface
{
    /**
     * @return int|null
     */
    public function getExternalId(): ?int;

    /**
     * @param int $id
     */
    public function setExternalId(int $id): void;

    /**
     * @return bool
     */
    public function hasExternalId(): bool;

    /**
     * Forget about all differences
     */
    public function flush(): void;
}
