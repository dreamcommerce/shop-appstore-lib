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

final class Update extends Operation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $data;

    /**
     * @param ItemResourceInterface $resource
     * @param int $id
     * @param array $data
     */
    public function __construct(ItemResourceInterface $resource, int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;

        parent::__construct($resource);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}