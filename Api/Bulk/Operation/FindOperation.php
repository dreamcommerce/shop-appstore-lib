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

final class FindOperation extends BaseOperation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param ItemResourceInterface $resource
     * @param int $id
     */
    public function __construct(ItemResourceInterface $resource, int $id)
    {
        $this->id = $id;

        parent::__construct($resource);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
