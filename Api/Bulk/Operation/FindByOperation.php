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

namespace DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation;

use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;

final class FindByOperation extends BaseOperation
{
    /**
     * @var Criteria
     */
    private $criteria;

    /**
     * @param ItemResourceInterface $resource
     * @param Criteria $criteria
     */
    public function __construct(ItemResourceInterface $resource, Criteria $criteria)
    {
        $this->criteria = $criteria;

        parent::__construct($resource);
    }

    /**
     * @return Criteria
     */
    public function getCriteria(): Criteria
    {
        return $this->criteria;
    }
}