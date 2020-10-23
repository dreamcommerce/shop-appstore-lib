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

namespace DreamCommerce\Component\ShopAppstore\Tests\Fixtures\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResource;

final class ExampleItemResource extends ItemResource
{
    public function getName(): string
    {
        return 'example_item_resources';
    }

    public function getExternalIdName(): string
    {
        return 'field_id';
    }

    public function getObjectName(): string
    {
        return 'example_item_resource';
    }
}
