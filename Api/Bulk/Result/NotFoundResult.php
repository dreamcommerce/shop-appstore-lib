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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\BaseOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

final class NotFoundResult extends ErrorResult
{
    /**
     * @param BaseOperation $operation
     * @param ShopInterface $shop
     * @param string|null $error
     * @param string|null $errorDescription
     */
    public function __construct(BaseOperation $operation,
                                ShopInterface $shop,
                                string $error = null,
                                string $errorDescription = null
    ) {
        parent::__construct($operation, $shop, 404, $error, $errorDescription);
    }
}