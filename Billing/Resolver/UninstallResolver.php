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
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Uninstall;
use DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\ShopTransitions;
use SM\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class UninstallResolver implements ResolverInterface
{
    /**
     * @var FactoryInterface
     */
    private $shopStateMachineFactory;

    /**
     * @param FactoryInterface $shopStateMachineFactory
     */
    public function __construct(FactoryInterface $shopStateMachineFactory)
    {
        $this->shopStateMachineFactory = $shopStateMachineFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message): void
    {
        Assert::isInstanceOf($message, Uninstall::class);

        $shop = $message->getShop();

        $stateMachine = $this->shopStateMachineFactory->get($shop, ShopTransitions::GRAPH);
        switch ($shop->getState()) {
            case OAuthShopInterface::STATE_PREFETCH_TOKENS:
                $transition = ShopTransitions::TRANSITION_CANCEL_DOWNLOAD_TOKENS;

                break;
            case OAuthShopInterface::STATE_REJECTED_AUTH_CODE:
                $transition = ShopTransitions::TRANSITION_GIVE_UP;

                break;
            case OAuthShopInterface::STATE_INSTALLED:
                $transition = ShopTransitions::TRANSITION_UNINSTALL;

                break;
            default:
                throw UnableDispatchException::forUnsupportedShopState($shop, $message);
        }

        $stateMachine->apply($transition);
    }
}
