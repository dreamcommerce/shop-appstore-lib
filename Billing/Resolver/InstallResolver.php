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

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Install;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Message;
use DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\ShopTransitions;
use SM\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class InstallResolver implements ResolverInterface
{
    /**
     * @var FactoryInterface
     */
    private $shopStateMachineFactory;

    /**
     * @var AuthenticatorInterface
     */
    private $authenticator;

    /**
     * @param FactoryInterface $shopStateMachineFactory
     * @param AuthenticatorInterface $authenticator
     */
    public function __construct(FactoryInterface $shopStateMachineFactory, AuthenticatorInterface $authenticator)
    {
        $this->shopStateMachineFactory = $shopStateMachineFactory;
        $this->authenticator = $authenticator;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Message $message): void
    {
        /** @var Install $message */
        Assert::isInstanceOf($message, Install::class);

        $shop = $message->getShop();
        $appVersion = $message->getApplicationVersion();

        if ($appVersion > $shop->getVersion()) {
            $shop->setVersion($appVersion);
        }

        $stateMachine = $this->shopStateMachineFactory->get($shop, ShopTransitions::GRAPH);
        switch ($shop->getState()) {
            case OAuthShopInterface::STATE_NEW:
                $transition = ShopTransitions::TRANSITION_ENQUEUE_DOWNLOAD_TOKENS;

                break;
            case OAuthShopInterface::STATE_PREFETCH_TOKENS:
                $transition = ShopTransitions::TRANSITION_RETRY_DOWNLOAD_TOKENS;

                break;
            case OAuthShopInterface::STATE_REJECTED_AUTH_CODE:
                $transition = ShopTransitions::TRANSITION_REFRESH_AUTH_CODE;

                break;
            case OAuthShopInterface::STATE_UNINSTALLED:
                $transition = ShopTransitions::TRANSITION_REINSTALL;

                break;
            default:
                throw UnableDispatchException::forUnsupportedShopState($shop, $message);
        }
        $stateMachine->apply($transition);

        $this->authenticator->authenticate($shop);
    }
}
