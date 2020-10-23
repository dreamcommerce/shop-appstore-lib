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

interface ShopItemPartListInterface extends ShopDependInterface
{
    /**
     * @return int
     */
    public function getTotal(): int;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @return int
     */
    public function getTotalPages(): int;
}
