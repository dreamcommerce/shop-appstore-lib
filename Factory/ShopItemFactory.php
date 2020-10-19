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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Api\Resource\MetafieldResource as MetafieldResource;
use DreamCommerce\Component\ShopAppstore\Api\Resource\MetafieldValueResource as MetafieldValueResource;
use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValue;
use DreamCommerce\Component\ShopAppstore\Model\ShopItem;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ShopItemFactory extends AbstractFactory implements ShopItemFactoryInterface
{
    /**
     * @var array
     */
    protected $discriminatorMap = [
        MetafieldValueResource::class => MetafieldValue::class
    ];

    /**
     * @param DataFactoryInterface $dataFactory
     * @param array $resourceMap
     */
    public function __construct(DataFactoryInterface $dataFactory, array $resourceMap = array())
    {
        if(!isset($resourceMap[MetafieldResource::class])) {
            $resourceMap[MetafieldResource::class] = Metafield::class;
        }
        parent::__construct($dataFactory, $resourceMap);
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new ShopItem();
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiResource(ItemResourceInterface $resource, ShopInterface $shop, array $data): ShopItemInterface
    {
        $class = get_class($resource);
        if(isset($this->resourceMap[$class])) {
            $item = new $this->resourceMap[$class];
        } elseif(isset($this->discriminatorMap[$class])) {
            $itemClass = $this->discriminatorMap[$class];

            $mapClass = $itemClass::getMapClass();
            $mapField = $itemClass::getMapField();

            if(!isset($data[$mapField])) {
                throw new \RuntimeException(); // TODO
            }
            $field = (int) $data[$mapField];

            if(!isset($mapClass[$field])) {
                throw new \RuntimeException(); // TODO
            }

            $item = new $mapClass[$field];
        } else {
            $item = $this->createNew();
        }

        $item->setShop($shop);
        $this->createFromArray($data, $item);

        $fieldName = $resource->getExternalIdName();
        $item->setExternalId((int)$item->getFieldValue($fieldName));

        return $item;
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiRequest(ItemResourceInterface $resource, ShopInterface $shop,
                                       RequestInterface $request, ResponseInterface $response): ShopItemInterface
    {
        return $this->createByApiResource($resource, $shop, $this->handleApiRequest($request, $response));
    }
}