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

class ParcelResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * It's not possibly to modify shipped parcel except shipping code
     */
    const HTTP_ERROR_PARCEL_CAN_NOT_MODIFY = 'parcel_cannot_modify';

    /**
     * Parcel has been already sent
     */
    const HTTP_ERROR_PARCEL_IS_ALREADY_SENT = 'parcel_already_sent';

    /**
     * address is used for billing purposes
     */
    const ADDRESS_TYPE_BILLING = 1;

    /**
     * address is used for delivery purposes
     */
    const ADDRESS_TYPE_DELIVERY = 2;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'parcels';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'parcel_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'parcel';
    }
}
