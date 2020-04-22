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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\ItemResource;

class Progress extends ItemResource implements ObjectAwareInterface
{
    const STATUS_PENDING = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_FINISHED = 2;
    const STATUS_ABORTED = 3;
    const STATUS_FAILED = 4;
    const STATUS_FINISHED_CLOSED = 5;
    const STATUS_ABORTED_CLOSED = 6;
    const STATUS_FAILED_CLOSED = 7;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'progresses';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'progress_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'progress';
    }
}