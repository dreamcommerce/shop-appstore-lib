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

use DreamCommerce\Component\ShopAppstore\Api\Authenticator\AuthenticatorInterface;
use DreamCommerce\Component\ShopAppstore\Api\Authenticator\FrontBasicAuthAuthenticator;
use DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClient;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Factory\DataFactory;
use DreamCommerce\Component\ShopAppstore\Factory\DataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Factory\ShopFrontDataFactory;
use DreamCommerce\Component\ShopAppstore\Factory\ShopFrontDataFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\BasicAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use Psr\Http\Message\UriInterface;
use RuntimeException;

abstract class FrontResource implements FrontResourceInterface
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
     * @var ShopFrontDataFactoryInterface
     */
    protected $shopFrontDataFactory;

    /**
     * @var ShopFrontDataFactoryInterface
     */
    protected static $globalShopFrontDataFactory;

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
        BasicAuthShopInterface::class => FrontBasicAuthAuthenticator::class,
    ];

    /**
     * @var AuthenticatorInterface[]
     */
    protected static $globalAuthInstances = [];

    /**
     * @param ShopClientInterface|null $shopClient
     * @param AuthenticatorInterface|null $authenticator
     * @param ShopFrontDataFactoryInterface|null $shopFrontDataFactory
     */
    public function __construct(ShopClientInterface $shopClient = null,
                                AuthenticatorInterface $authenticator = null,
                                ShopFrontDataFactoryInterface $shopFrontDataFactory = null
    ) {
        $this->shopClient = $shopClient;
        $this->authenticator = $authenticator;
        $this->shopFrontDataFactory = $shopFrontDataFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(FrontShopInterface $shop, array $data = array(), array $uriData = array(), array $queryParameters = array()): DataInterface
    {
        if (!$this->isPublic() && !$shop->isAuthenticated()) {
            $authenticator = $this->getAuthByShop($shop);
            $authenticator->authenticate($shop);
        }

        $shopClient = $this->getShopClient();
        $method = $this->getMethod();

        $body = null;
        if ($data !== null && in_array($method, ['POST', 'PUT'])) {
            $body = @json_encode($data);
            if ($body === false) {
                throw CommunicationException::forInvalidRequestBody($data);
            }
        }

        $headers = [
            'Content-Type' => 'application/json',
        ];

        if ($shop->isAuthenticated()) {
            $headers['Cookie'] = ['Shop5=' . $shop->getToken()->getAccessToken()];
        }

        $uri = $this->getUri($shop, $uriData);
        $uri = $uri->withQuery(http_build_query($queryParameters, '', '&'));

        $request = $shopClient->getHttpClient()->createRequest(
            $method,
            $uri,
            $headers,
            $body
        );

        $response = $shopClient->send($request);
        $shopDataFactory = $this->getShopDataFactory();

        return $shopDataFactory->createByApiRequest($this, $shop, $request, $response);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * {@inheritDoc}
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupportedLanguage(): bool
    {
        return true;
    }

    /**
     * @param FrontShopInterface $shop
     * @param array $uriData
     *
     * @return UriInterface
     */
    protected function getUri(FrontShopInterface $shop, array $uriData): UriInterface
    {
        $uri = $shop->getUri();
        $uriPath = rtrim($uri->getPath(), '/') . '/webapi/front';
        if($this->isSupportedLanguage()) {
            $uriPath .= '/' . $shop->getLanguage();
        }
        return $uri->withPath($uriPath);
    }

    /**
     * @param FrontShopInterface $shop
     *
     * @return AuthenticatorInterface
     */
    protected function getAuthByShop(FrontShopInterface $shop): AuthenticatorInterface
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

    /**
     * @return ShopFrontDataFactoryInterface
     */
    protected function getShopDataFactory(): ShopFrontDataFactoryInterface
    {
        if ($this->shopFrontDataFactory !== null) {
            return $this->shopFrontDataFactory;
        }

        if (self::$globalShopFrontDataFactory === null) {
            self::$globalShopFrontDataFactory = new ShopFrontDataFactory($this->getGlobalDataFactory());
        }

        return self::$globalShopFrontDataFactory;
    }
}
