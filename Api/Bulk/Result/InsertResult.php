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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\InsertOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;

class InsertResult extends BaseResult
{
    /**
     * @var ShopItemInterface
     */
    private $item;

    /**
     * @param InsertOperation $operation
     * @param ShopInterface $shop
     * @param ShopItemInterface $item
     */
    public function __construct(InsertOperation $operation, ShopInterface $shop, ShopItemInterface $item)
    {
        $this->item = $item;
        parent::__construct($operation, $shop);
    }

    /**
     * @return ShopItemInterface
     */
    public function getItem(): ShopItemInterface
    {
        return $this->item;
    }
}
