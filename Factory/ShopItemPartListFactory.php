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

use DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException;
use DreamCommerce\Component\ShopAppstore\Api\Resource\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartList;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemPartListInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ShopItemPartListFactory implements ShopItemPartListFactoryInterface
{
    /**
     * @var ShopItemFactoryInterface
     */
    protected $shopItemFactory;

    /**
     * @param ShopItemFactoryInterface $shopItemFactory
     */
    public function __construct(ShopItemFactoryInterface $shopItemFactory)
    {
        $this->shopItemFactory = $shopItemFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new ShopItemPartList();
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiResource(
        ItemResourceInterface $resource,
        ShopInterface $shop,
        array $data
    ): ShopItemPartListInterface {
        $list = $this->createNew();
        $list->setShop($shop);

        if (isset($data['page'])) {
            $list->setPage((int) $data['page']);
        }
        if (isset($data['count'])) {
            $list->setTotal((int) $data['count']);
        }
        if (isset($data['pages'])) {
            $list->setTotalPages((int) $data['pages']);
        }

        $items = [];
        foreach ($data['list'] as $partData) {
            $items[] = $this->shopItemFactory->createByApiResource($resource, $shop, $partData);
        }
        $list->setItems($items);

        return $list;
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiRequest(
        ItemResourceInterface $resource,
        ShopInterface $shop,
        RequestInterface $request,
        ResponseInterface $response
    ): ShopItemPartListInterface {
        $stream = $response->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        if (strlen($body) === 0) {
            throw CommunicationException::forEmptyResponseBody($request, $response);
        }
        $body = @json_decode($body, true);

        if (!$body || !is_array($body)) {
            throw CommunicationException::forInvalidResponseBody($request, $response);
        }

        return $this->createByApiResource($resource, $shop, $body);
    }
}
