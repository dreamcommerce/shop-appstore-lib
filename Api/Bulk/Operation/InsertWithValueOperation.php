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

/**
 * @method MetafieldValueResourceInterface getResource()
 */
class InsertWithValueOperation extends InsertOperation
{
    /**
     * @var MetafieldInterface
     */
    private $metafield;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param MetafieldValueResourceInterface $resource
     * @param MetafieldInterface $metafield
     * @param mixed $value
     */
    public function __construct(MetafieldValueResourceInterface $resource, MetafieldInterface $metafield, $value, array $uriParameters = [])
    {
        $data = array(
            'metafield_id' => $metafield->getExternalId(),
            'value' => $value,
            'type' => $metafield->getType()
        );

        $this->metafield = $metafield;
        $this->value = $value;

        parent::__construct($resource, $data, $uriParameters);
    }

    /**
     * @return MetafieldInterface
     */
    public function getMetafield(): MetafieldInterface
    {
        return $this->metafield;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
