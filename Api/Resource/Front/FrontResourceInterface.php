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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource\Front;

use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;

interface FrontResourceInterface
{
    /**
     * @param FrontShopInterface $shop
     * @param array $data
     * @param array $uriData
     * @param array $queryParameters
     * @return DataInterface
     */
    public function execute(FrontShopInterface $shop, array $data = array(), array $uriData = array(), array $queryParameters = array()): DataInterface;

    /**
     * @return bool
     */
    public function isPublic(): bool;

    /**
     * @return bool
     */
    public function isSupportedLanguage(): bool;
}
