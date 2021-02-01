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

namespace DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation;

use DreamCommerce\Component\ShopAppstore\Api\Resource\MetafieldValueResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;

/**
 * @method MetafieldValueResourceInterface getResource()
 */
class InsertWithObjectValueOperation extends InsertOperation
{
    /**
     * @var MetafieldInterface
     */
    private $metafield;

    /**
     * @var ShopItemInterface
     */
    private $item;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param MetafieldValueResourceInterface $resource
     * @param MetafieldInterface $metafield
     * @param ShopItemInterface $item
     * @param mixed $value
     */
    public function __construct(MetafieldValueResourceInterface $resource, MetafieldInterface $metafield, ShopItemInterface $item, $value)
    {
        $data = array(
            'metafield_id' => $metafield->getExternalId(),
            'object_id' => $item->getExternalId(),
            'value' => $value
        );

        $this->metafield = $metafield;
        $this->item = $item;
        $this->value = $value;

        parent::__construct($resource, $data);
    }

    /**
     * @return MetafieldInterface
     */
    public function getMetafield(): MetafieldInterface
    {
        return $this->metafield;
    }

    /**
     * @return ShopItemInterface
     */
    public function getItem(): ShopItemInterface
    {
        return $this->item;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
