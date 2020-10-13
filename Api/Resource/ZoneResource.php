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

class ZoneResource extends ItemResource implements ObjectAwareInterface
{
    /**
     * zone division by countries
     */
    const ZONE_MODE_COUNTRIES = 1;

    /**
     * zone division by regions
     */
    const ZONE_MODE_REGIONS = 2;

    /**
     * zone supports post codes
     */
    const ZONE_MODE_CODES = 3;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'zones';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'zone_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'zone';
    }
}