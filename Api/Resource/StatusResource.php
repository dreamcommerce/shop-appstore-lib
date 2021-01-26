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

class StatusResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * status: new
     */
    const TYPE_NEW = 1;

    /**
     * status: opened
     */
    const TYPE_OPENED = 2;

    /**
     * status: closed
     */
    const TYPE_CLOSED = 3;

    /**
     * status: not completed
     */
    const TYPE_UNREALIZED = 4;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'status_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'status';
    }
}
