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

use DreamCommerce\Component\ShopAppstore\Billing\DispatcherInterface;
use InvalidArgumentException;
use Sylius\Component\Registry\ServiceRegistry;

final class ResolverRegistry extends ServiceRegistry
{
    public function __construct($context = 'service')
    {
        parent::__construct(ResolverInterface::class, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $identifier): bool
    {
        if (!in_array($identifier, array_keys(DispatcherInterface::ACTION_PAYLOAD_MAP))) {
            throw new InvalidArgumentException('Action "' . $identifier . '" is not supported');
        }

        return parent::has($identifier);
    }
}
