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

class OptionResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * It's not possible to change required flag for option with warehouse support
     */
    const HTTP_ERROR_OPTION_CAN_NOT_MODIFY_REQUIRE = 'option_cannot_modify_require';

    /**
     * It's not possible to change type of an existing option
     */
    const HTTP_ERROR_OPTION_CAN_NOT_MODIFY_TYPE = 'option_cannot_modify_type';

    /**
     * option type file input
     */
    const TYPE_FILE = 'file';
    /**
     * option type text
     */
    const TYPE_TEXT = 'text';
    /**
     * option type radio ption
     */
    const TYPE_RADIO = 'radio';
    /**
     * option type select (drop down)
     */
    const TYPE_SELECT = 'select';
    /**
     * option type checkbox
     */
    const TYPE_CHECKBOX = 'checkbox';
    /**
     * option type color
     */
    const TYPE_COLOR = 'color';

    /**
     * option value decreases price
     */
    const PRICE_TYPE_DECREASE = -1;
    /**
     * option value doesn't change price
     */
    const PRICE_TYPE_KEEP = 0;
    /**
     * option value increases price
     */
    const PRICE_TYPE_INCREASE = 1;

    /**
     * price is modified by percent
     */
    const PRICE_PERCENT = 0;
    /**
     * price is modified by amount
     */
    const PRICE_AMOUNT = 1;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'option_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'option';
    }
}
