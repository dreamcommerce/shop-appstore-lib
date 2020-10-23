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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\FetchOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopDataInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

final class FetchResult extends BaseResult
{
    /**
     * @var ShopDataInterface
     */
    private $data;

    /**
     * @param FetchOperation $operation
     * @param ShopInterface $shop
     * @param ShopDataInterface $data
     */
    public function __construct(FetchOperation $operation, ShopInterface $shop, ShopDataInterface $data)
    {
        $this->data = $data;
        parent::__construct($operation, $shop);
    }

    /**
     * @return ShopDataInterface
     */
    public function getData(): ShopDataInterface
    {
        return $this->data;
    }
}
