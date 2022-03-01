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

use DreamCommerce\Component\ShopAppstore\Api\Resource\ResourceInterface;

abstract class BaseOperation
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * @var array
     */
    private $uriParameters;

    /**
     * @param ResourceInterface $resource
     */
    public function __construct(ResourceInterface $resource, array $uriParameters = [])
    {
        $this->resource = $resource;
        $this->uriParameters = $uriParameters;
    }

    /**
     * @return ResourceInterface
     */
    public function getResource(): ResourceInterface
    {
        return $this->resource;
    }

    public function getUriParameters(): array
    {
        return $this->uriParameters;
    }
}
