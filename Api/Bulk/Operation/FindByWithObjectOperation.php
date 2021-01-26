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
use DreamCommerce\Component\ShopAppstore\Api\Resource\ObjectAwareResourceInterface;

class FindByWithObjectOperation extends FindByOperation implements ObjectOperationInterface
{
    /**
     * @var ObjectAwareResourceInterface
     */
    private $objectResource;

    /**
     * @param ItemResourceInterface $resource
     * @param Criteria $criteria
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function __construct(ItemResourceInterface $resource, Criteria $criteria, ObjectAwareResourceInterface $objectResource)
    {
        $this->objectResource = $objectResource;

        parent::__construct($resource, $criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectResource(): ObjectAwareResourceInterface
    {
        return $this->objectResource;
    }
}
