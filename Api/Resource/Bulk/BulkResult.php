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

class BulkResult implements BulkResultInterface
{
    /**
     * @var Result\BaseResult[]
     */
    private $results = array();

    /**
     * @param Result\BaseResult[] $results
     */
    public function __construct(array $results = array())
    {
        $this->results = $results;
    }

    /**
     * {@inheritDoc}
     */
    public function getResults(): array
    {
        return $this->results;
    }
}