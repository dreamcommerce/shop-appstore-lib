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

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\BulkContainerInterface;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopDataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopItemPartListFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\ResponseInterface;

class BulkResource extends Resource implements BulkResourceInterface
{
    use ShopDataTrait;
    use ShopItemTrait;

    const MAX_API_CALLS = 25;

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopDataFactoryInterface|null $shopDataFactory
     * @param ShopItemFactoryInterface|null $shopItemFactory
     * @param ShopItemPartListFactoryInterface|null $shopItemPartListFactory
     * @param ShopItemListFactoryInterface|null $shopItemListFactory
     */
    public function __construct(ShopClientInterface $shopClient = null,
                                AuthenticatorInterface $authenticator = null,
                                ShopDataFactoryInterface $shopDataFactory = null,
                                ShopItemFactoryInterface $shopItemFactory = null,
                                ShopItemPartListFactoryInterface $shopItemPartListFactory = null,
                                ShopItemListFactoryInterface $shopItemListFactory = null
    ) {
        $this->shopDataFactory = $shopDataFactory;
        $this->shopItemFactory = $shopItemFactory;
        $this->shopItemPartListFactory = $shopItemPartListFactory;
        $this->shopItemListFactory = $shopItemListFactory;

        parent::__construct($shopClient, $authenticator);
    }

    /**
     * {@inheritDoc}
     */
    public function execute(ShopInterface $shop, BulkContainerInterface $container): BulkResult
    {
        $rows = array();

        foreach($container->getOperations() as $key => $operation) {
            $row = array(
                'id' => $key
            );

            switch(get_class($operation)) {
                case Bulk\Fetch::class:
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $operation->getResourceName());
                    break;
                case Bulk\Find::class:
                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $operation->getResourceName());
                    break;
                case Bulk\FindBy::class:
                    /** @var Criteria $criteria */
                    $criteria = clone $operation->getCriteria();
                    $criteria->rewind();

                    $row['method'] = 'GET';
                    $row['path'] = $this->getUri($shop, null, $operation->getResourceName());
                    $row['params'] = $criteria->getQueryParams();
                    break;
                case Bulk\Insert::class:
                    $row['method'] = 'POST';
                    $row['path'] = $this->getUri($shop, null, $operation->getResourceName());
                    $row['body'] = $operation->getData();
                    break;
                case Bulk\Update::class:
                    $row['method'] = 'PUT';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $operation->getResourceName());
                    $row['body'] = $operation->getData();
                    break;
                case Bulk\Delete::class:
                    $row['method'] = 'DELETE';
                    $row['path'] = $this->getUri($shop, $operation->getId(), $operation->getResourceName());
                    break;
            }
        }

        /** @var ResponseInterface $response */
        list(, $response) = $this->perform($shop, 'POST', null, $rows);

        // TODO
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'bulk';
    }
}