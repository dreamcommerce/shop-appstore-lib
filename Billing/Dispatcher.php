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

namespace DreamCommerce\Component\ShopAppstore\Billing;

use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\Common\Exception\NotDefinedException;
use DreamCommerce\Component\Common\Factory\UriFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException;
use DreamCommerce\Component\ShopAppstore\Factory\OAuthShopFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Repository\ShopRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Sylius\Component\Registry\NonExistingServiceException;
use Sylius\Component\Registry\ServiceRegistryInterface;

final class Dispatcher implements DispatcherInterface
{
    /**
     * @var ServiceRegistryInterface
     */
    private $applicationRegistry;

    /**
     * @var ShopRepositoryInterface
     */
    private $shopRepository;

    /**
     * @var OAuthShopFactoryInterface
     */
    private $shopFactory;

    /**
     * @var ObjectManager
     */
    private $shopObjectManager;

    /**
     * @var UriFactoryInterface
     */
    private $uriFactory;

    /**
     * @var ServiceRegistryInterface
     */
    private $resolverRegistry;

    /**
     * @param ServiceRegistryInterface $applicationRegistry
     * @param ShopRepositoryInterface $shopRepository
     * @param OAuthShopFactoryInterface $shopFactory
     * @param ObjectManager $shopObjectManager
     * @param UriFactoryInterface $uriFactory
     * @param ServiceRegistryInterface $resolverRegistry
     */
    public function __construct(
        ServiceRegistryInterface $applicationRegistry,
        ShopRepositoryInterface $shopRepository,
        OAuthShopFactoryInterface $shopFactory,
        ObjectManager $shopObjectManager,
        UriFactoryInterface $uriFactory,
        ServiceRegistryInterface $resolverRegistry
    ) {
        $this->applicationRegistry = $applicationRegistry;
        $this->shopRepository = $shopRepository;
        $this->shopFactory = $shopFactory;
        $this->shopObjectManager = $shopObjectManager;
        $this->uriFactory = $uriFactory;
        $this->resolverRegistry = $resolverRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(ServerRequestInterface $serverRequest): void
    {
        if ($serverRequest->getMethod() !== 'POST') {
            throw UnableDispatchException::forInvalidRequestMethod($serverRequest);
        }

        $params = $serverRequest->getParsedBody();

        try {
            $this->verifyRequirements($params);
        } catch (NotDefinedException $exception) {
            throw UnableDispatchException::forUnfulfilledRequirements($serverRequest, $exception);
        }

        try {
            /** @var ApplicationInterface $application */
            $application = $this->applicationRegistry->get($params['application_code']);
        } catch (NonExistingServiceException $exception) {
            throw UnableDispatchException::forNotExistApplication($serverRequest, $exception);
        }

        $this->verifyPayload($serverRequest, $application, $params);

        /** @var UriInterface $shopUri */
        $shopUri = $this->uriFactory->createNewByUriString($params['shop_url']);

        $shop = $this->shopRepository->findOneByNameAndApplication($params['shop'], $application);
        if ($shop === null) {
            $shop = $this->shopFactory->createNewByApplicationAndUri($application, $shopUri);
        } else {
            $shop->setUri($shopUri);
        }

        try {
            /** @var ResolverInterface $resolver */
            $resolver = $this->resolverRegistry->get($params['action']);
        } catch (NonExistingServiceException $exception) {
            throw UnableDispatchException::forNotSupportedAction($serverRequest, $exception);
        }

        $resolver->resolve($this->getPayload($application, $shop, $params));

        $this->shopObjectManager->persist($shop);
        $this->shopObjectManager->flush();
    }

    /**
     * @param array $params
     *
     * @throws NotDefinedException
     */
    private function verifyRequirements(array $params = []): void
    {
        $requiredParams = ['action', 'shop', 'shop_url', 'hash', 'timestamp', 'application_code'];

        if (isset($params['action']) && !empty($params['action'])) {
            switch ($params['action']) {
                case self::ACTION_BILLING_SUBSCRIPTION:
                    $requiredParams[] = 'subscription_end_time';

                    break;
                case self::ACTION_INSTALL:
                    $requiredParams[] = 'application_version';
                    $requiredParams[] = 'auth_code';

                    break;
                case self::ACTION_UPGRADE:
                    $requiredParams[] = 'application_version';

                    break;
            }
        } else {
            throw NotDefinedException::forParameter('action');
        }

        foreach ($requiredParams as $requiredParam) {
            if (!isset($params[$requiredParam]) || empty($params[$requiredParam])) {
                throw NotDefinedException::forParameter($requiredParam);
            }
        }
    }

    private function verifyPayload(ServerRequestInterface $serverRequest, ApplicationInterface $application, array $params): void
    {
        $providedHash = $params['hash'];
        unset($params['hash']);

        // sort params
        ksort($params);

        $processedPayload = '';
        foreach ($params as $k => $v) {
            $processedPayload .= '&' . $k . '=' . $v;
        }
        $processedPayload = substr($processedPayload, 1);

        $computedHash = hash_hmac('sha512', $processedPayload, $application->getAppstoreSecret());
        if ((string) $computedHash !== (string) $providedHash) {
            throw UnableDispatchException::forInvalidPayloadHash($serverRequest, $application);
        }
    }

    /**
     * @param ApplicationInterface $application
     * @param OAuthShopInterface $shop
     * @param array $params
     *
     * @return Payload\Message
     */
    private function getPayload(ApplicationInterface $application, OAuthShopInterface $shop, array $params): Payload\Message
    {
        $messageClass = self::ACTION_PAYLOAD_MAP[$params['action']];

        unset($params['action'], $params['shop'], $params['shop_url'], $params['application_code']);

        return new $messageClass($application, $shop, $params);
    }
}
