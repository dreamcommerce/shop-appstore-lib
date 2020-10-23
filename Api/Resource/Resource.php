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

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Authenticator\BasicAuthAuthenticator;
use DreamCommerce\Component\ShopAppstore\Api\Authenticator\OAuthAuthenticator;
use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException;
use DreamCommerce\Component\ShopAppstore\Api\Http\Middleware;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClient;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\DataFactory;
use DreamCommerce\Component\ShopAppstore\Factory\DataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\BasicAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\UriInterface;
use RuntimeException;

abstract class Resource implements ResourceInterface
{
    /**
     * @var ShopClientInterface|null
     */
    protected $shopClient;

    /**
     * @var AuthenticatorInterface|null
     */
    protected $authenticator;

    /**
     * @var DataFactoryInterface
     */
    protected static $globalDataFactory;

    /**
     * @var ShopClientInterface
     */
    protected static $globalShopClient;

    /**
     * @var array
     */
    protected static $globalAuthMap = [
        BasicAuthShopInterface::class => BasicAuthAuthenticator::class,
        OAuthShopInterface::class => OAuthAuthenticator::class,
    ];

    /**
     * @var AuthenticatorInterface[]
     */
    protected static $globalAuthInstances = [];

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     */
    public function __construct(ShopClientInterface $shopClient = null, AuthenticatorInterface $authenticator = null)
    {
        $this->shopClient = $shopClient;
        $this->authenticator = $authenticator;
    }

    /**
     * @param ShopInterface $shop
     * @param string $method
     * @param int|null $id
     * @param array|null $data
     * @param Criteria|null $criteria
     *
     * @return array
     *
     * @throws CommunicationException
     */
    protected function perform(ShopInterface $shop, string $method, int $id = null, array $data = null, Criteria $criteria = null): array
    {
        if (!$shop->isAuthenticated()) {
            $authenticator = $this->getAuthByShop($shop);
            $authenticator->authenticate($shop);
        }

        $shopClient = $this->getShopClient();

        $body = null;
        if ($data !== null && in_array($method, ['POST', 'PUT'])) {
            $body = @json_encode($data);
            if ($body === false) {
                throw CommunicationException::forInvalidRequestBody($data);
            }
        }

        $request = $shopClient->getHttpClient()->createRequest(
            $method,
            $this->getUri($shop, $id),
            [
                'Authorization' => 'Bearer ' . $shop->getToken()->getAccessToken(),
                'Content-Type' => 'application/json',
            ],
            $body
        );
        if ($criteria !== null) {
            $request = $criteria->fillRequest($request);
        }

        return [$request, $shopClient->send($request)];
    }

    /**
     * @param ShopInterface $shop
     * @param int|null $id
     * @param string|null $name
     *
     * @return UriInterface
     */
    protected function getUri(ShopInterface $shop, int $id = null, string $name = null): UriInterface
    {
        if ($name === null) {
            $name = $this->getName();
        }

        $uri = $shop->getUri();
        $uri = $uri->withPath(rtrim($uri->getPath(), '/') . '/webapi/rest/' . $name);

        if ($id !== null) {
            $uri = $uri->withPath($uri->getPath() . '/' . $id);
        }

        return $uri;
    }

    /**
     * @param ShopInterface $shop
     *
     * @return AuthenticatorInterface
     */
    protected function getAuthByShop(ShopInterface $shop): AuthenticatorInterface
    {
        if ($this->authenticator !== null) {
            return $this->authenticator;
        }

        foreach (self::$globalAuthMap as $shopClass => $authClass) {
            if ($shop instanceof $shopClass) {
                return $this->getAuthInstance($authClass);
            }
        }

        throw new RuntimeException('Unable find authenticator for class "' . get_class($shop) . '"');
    }

    /**
     * @param string $authClass
     *
     * @return AuthenticatorInterface
     */
    protected function getAuthInstance(string $authClass): AuthenticatorInterface
    {
        if (!isset(self::$globalAuthInstances[$authClass])) {
            self::$globalAuthInstances[$authClass] = new $authClass($this->getShopClient());
        }

        return self::$globalAuthInstances[$authClass];
    }

    /**
     * @return ShopClientInterface
     */
    protected function getShopClient(): ShopClientInterface
    {
        if ($this->shopClient !== null) {
            return $this->shopClient;
        }

        if (self::$globalShopClient === null) {
            self::$globalShopClient = new ShopClient();
            self::$globalShopClient->register(new Middleware\Locale());
            self::$globalShopClient->register(new Middleware\UserAgent());
            self::$globalShopClient->register(new Middleware\AwaitConnection(), ShopClientInterface::PRIORITY_MIN);
        }

        return self::$globalShopClient;
    }

    /**
     * @return DataFactoryInterface
     */
    protected function getGlobalDataFactory(): DataFactoryInterface
    {
        if (self::$globalDataFactory === null) {
            self::$globalDataFactory = new DataFactory();
        }

        return self::$globalDataFactory;
    }
}
