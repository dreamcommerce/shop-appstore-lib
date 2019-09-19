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

namespace DreamCommerce\Component\ShopAppstore\Billing\Resolver;

use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Upgrade;
use Webmozart\Assert\Assert;

final class UpgradeResolver implements ResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message): void
    {
        /** @var Upgrade $message */
        Assert::isInstanceOf($message, Upgrade::class);

        $shop = $message->getShop();
        $appVersion = $message->getApplicationVersion();

        if ($appVersion > $shop->getVersion()) {
            $shop->setVersion($appVersion);
        }
    }
}
