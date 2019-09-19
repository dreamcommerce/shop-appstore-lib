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

final class ShopTransitions
{
    public const GRAPH = 'dream_commerce_appstore_shop';

    public const TRANSITION_INSTALL = 'install';
    public const TRANSITION_UNINSTALL = 'uninstall';
    public const TRANSITION_REINSTALL = 'reinstall';
    public const TRANSITION_REFRESH_AUTH_CODE = 'refresh_auth_code';
    public const TRANSITION_REJECT_AUTH_CODE = 'reject_auth_code';
    public const TRANSITION_ENQUEUE_DOWNLOAD_TOKENS = 'enqueue_download_tokens';
    public const TRANSITION_CANCEL_DOWNLOAD_TOKENS = 'cancel_download_tokens';
    public const TRANSITION_RETRY_DOWNLOAD_TOKENS = 'retry_download_tokens';
    public const TRANSITION_GIVE_UP = 'give_up';

    private function __construct()
    {
    }
}
