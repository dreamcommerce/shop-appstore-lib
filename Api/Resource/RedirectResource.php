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

class RedirectResource extends ItemResource implements ObjectAwareInterface
{
    const TYPE_OWN = 0;
    const TYPE_PRODUCT = 1;
    const TYPE_CATEGORY = 2;
    const TYPE_PRODUCER = 3;
    const TYPE_ABOUT_PAGE = 4;
    const TYPE_NEWS = 5;
    const TYPE_NEWS_CATEGORY = 6;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'redirects';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'redirect_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'redirect';
    }
}
