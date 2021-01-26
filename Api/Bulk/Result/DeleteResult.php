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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\DeleteOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

class DeleteResult extends BaseResult
{
    /**
     * @param DeleteOperation $operation
     * @param ShopInterface $shop
     */
    public function __construct(DeleteOperation $operation, ShopInterface $shop)
    {
        parent::__construct($operation, $shop);
    }
}
