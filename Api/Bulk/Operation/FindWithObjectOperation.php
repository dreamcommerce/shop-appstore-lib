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

use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ObjectAwareResourceInterface;

class FindWithObjectOperation extends FindOperation implements ObjectOperationInterface
{
    /**
     * @var ObjectAwareResourceInterface
     */
    private $objectResource;

    /**
     * @param ItemResourceInterface $resource
     * @param int $id
     * @param ObjectAwareResourceInterface $objectResource
     */
    public function __construct(ItemResourceInterface $resource, int $id, ObjectAwareResourceInterface $objectResource)
    {
        $this->objectResource = $objectResource;

        parent::__construct($resource, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectResource(): ObjectAwareResourceInterface
    {
        return $this->objectResource;
    }
}
