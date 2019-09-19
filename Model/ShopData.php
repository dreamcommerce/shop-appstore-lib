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

class ShopData extends Data implements ShopDataInterface
{
    use ShopDependTrait;

    /**
     * @param ShopInterface|null $shop
     * @param array $data
     */
    public function __construct(ShopInterface $shop = null, array $data = [])
    {
        parent::__construct($data);

        $this->shop = $shop;
    }
}