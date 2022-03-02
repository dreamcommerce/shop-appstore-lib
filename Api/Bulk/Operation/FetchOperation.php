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

use DreamCommerce\Component\ShopAppstore\Api\Resource\DataResourceInterface;

class FetchOperation extends BaseOperation
{
    /**
     * @param DataResourceInterface $resource
     */
    public function __construct(DataResourceInterface $resource, array $uriParameters = [])
    {
        parent::__construct($resource, $uriParameters);
    }
}
