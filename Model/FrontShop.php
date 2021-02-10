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

namespace DreamCommerce\Component\ShopAppstore\Model;

class FrontShop extends BasicAuthShop implements FrontShopInterface
{
    /**
     * @var string
     */
    private $language = 'en_US';

    /**
     * {@inheritDoc}
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * {@inheritDoc}
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }
}