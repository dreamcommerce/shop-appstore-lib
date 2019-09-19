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

namespace DreamCommerce\Component\ShopAppstore;

final class Info
{
    public const VERSION            = '2.0.0dev';
    public const TIMEZONE           = 'Europe/Warsaw';
    public const LOCALE             = 'en_US';
    public const HTTP_USER_AGENT    = 'DreamCommerce ShopAppStore Agent ' . self::VERSION;
    public const MAX_API_ITEMS      = 50;

    private function __construct()
    {
    }

    /**
     * @param string $version
     * @return int
     */
    public static function compareVersion(string $version): int
    {
        $version = strtolower($version);
        $version = preg_replace('/(\d)pr(\d?)/', '$1a$2', $version);

        return version_compare($version, strtolower(self::VERSION));
    }
}