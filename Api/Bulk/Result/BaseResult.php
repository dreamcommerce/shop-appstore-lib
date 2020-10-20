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

namespace DreamCommerce\Component\ShopAppstore\Api\Bulk\Result;

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\BaseOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

abstract class BaseResult
{
    /**
     * @var BaseOperation
     */
    private $operation;

    /**
     * @var ShopInterface
     */
    private $shop;

    /**
     * @param BaseOperation $operation
     * @param ShopInterface $shop
     */
    public function __construct(BaseOperation $operation, ShopInterface $shop)
    {
        $this->operation = $operation;
        $this->shop = $shop;
    }

    /**
     * @return BaseOperation
     */
    public function getOperation(): BaseOperation
    {
        return $this->operation;
    }

    /**
     * @return ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }
}