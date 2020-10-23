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

namespace DreamCommerce\Component\ShopAppstore\Repository;

use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\UriInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface ShopRepositoryInterface extends RepositoryInterface
{
    /**
     * @param ApplicationInterface $application
     *
     * @return OAuthShopInterface[]|iterable
     */
    public function findByApplication(ApplicationInterface $application): iterable;

    /**
     * @param string $name
     *
     * @return OAuthShopInterface|null
     */
    public function findOneByName(string $name): ?OAuthShopInterface;

    /**
     * @param string $name
     * @param ApplicationInterface $application
     *
     * @return OAuthShopInterface|null
     */
    public function findOneByNameAndApplication(string $name, ApplicationInterface $application): ?OAuthShopInterface;

    /**
     * @param string|UriInterface $uri
     *
     * @return ShopInterface|null
     */
    public function findOneByUri($uri): ?ShopInterface;

    /**
     * @param string|UriInterface $uri
     * @param ApplicationInterface $application
     *
     * @return OAuthShopInterface|null
     */
    public function findOneByUriAndApplication($uri, ApplicationInterface $application): ?OAuthShopInterface;
}
