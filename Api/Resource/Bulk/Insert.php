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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource\Bulk;

use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;

final class Insert extends Operation
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param ItemResourceInterface $resource
     * @param array $data
     */
    public function __construct(ItemResourceInterface $resource, array $data)
    {
        $this->data = $data;

        parent::__construct($resource);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}