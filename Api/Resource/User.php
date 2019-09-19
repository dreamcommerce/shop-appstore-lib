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

final class User extends ItemResource implements ObjectAwareInterface
{
    /**
     * user created via shop
     */
    const ORIGIN_SHOP = 0;

    /**
     * user created via Facebook
     */
    const ORIGIN_FACEBOOK = 1;

    /**
     * user created via mobile
     */
    const ORIGIN_MOBILE = 2;

    /**
     * user created via Allegro
     */
    const ORIGIN_ALLEGRO = 3;

    /**
     * text field
     */
    const FIELD_TYPE_TEXT = 1;

    /**
     * checkbox
     */
    const FIELD_TYPE_CHECKBOX = 2;

    /**
     * select (drop down)
     */
    const FIELD_TYPE_SELECT = 3;

    /**
     * show field for user
     */
    const FIELD_SHOW_USER = 1;

    /**
     * show field for client
     */
    const FIELD_SHOW_CLIENT = 2;

    /**
     * show field during registration
     */
    const FIELD_SHOW_REGISTRATION = 4;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'user_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'user';
    }
}