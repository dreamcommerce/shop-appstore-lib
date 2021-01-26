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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\FindByOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;

class FindByResult extends BaseResult
{
    /**
     * @var ShopItemPartListInterface
     */
    private $list;

    /**
     * @param FindByOperation $operation
     * @param ShopInterface $shop
     * @param ShopItemPartListInterface $list
     */
    public function __construct(FindByOperation $operation, ShopInterface $shop, ShopItemPartListInterface $list)
    {
        $this->list = $list;
        parent::__construct($operation, $shop);
    }

    /**
     * @return ShopItemPartListInterface
     */
    public function getList(): ShopItemPartListInterface
    {
        return $this->list;
    }
}
