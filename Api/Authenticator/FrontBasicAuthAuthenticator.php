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

namespace DreamCommerce\Component\ShopAppstore\Api\Authenticator;

use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\ShopAppstore\Api\Exception;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\BasicAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\FrontShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\Token;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class FrontBasicAuthAuthenticator implements AuthenticatorInterface
{
    /**
     * @var ShopClientInterface
     */
    protected $shopClient;

    /**
     * @var ObjectManager|null
     */
    protected $tokenObjectManager;

    /**
     * @var FactoryInterface|null
     */
    protected $tokenFactory;

    /**
     * @param ShopClientInterface $shopClient
     * @param ObjectManager|null $tokenObjectManager
     * @param FactoryInterface|null $tokenFactory
     */
    public function __construct(
        ShopClientInterface $shopClient,
        ObjectManager $tokenObjectManager = null,
        FactoryInterface $tokenFactory = null
    ) {
        $this->shopClient = $shopClient;
        $this->tokenObjectManager = $tokenObjectManager;
        $this->tokenFactory = $tokenFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(ShopInterface $shop): void
    {
        /** @var FrontShopInterface|BasicAuthShopInterface $shop */
        Assert::isInstanceOf($shop, FrontShopInterface::class);
        Assert::isInstanceOf($shop, BasicAuthShopInterface::class);

        $shopUri = $shop->getUri();

        $authUri = $shopUri
            ->withPath($shopUri->getPath() . '/webapi/front/' . $shop->getLanguage() . '/auth/login');

        $headers = $shop->getRequestBasicHeaders();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $headers['Authorization'] = 'Basic ' . base64_encode($shop->getUsername() . ':' . $shop->getPassword());

        $request = $this->shopClient->getHttpClient()->createRequest(
            'post',
            $authUri,
            $headers
        );

        $exception = null;

        try {
            $response = $this->shopClient->send($request);
        } catch (Exception\PermissionsException $exception) {
            $response = $exception->getHttpResponse();
        }

        $stream = $response->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        if (strlen($body) === 0) {
            throw Exception\CommunicationException::forEmptyResponseBody($request, $response, $exception);
        }
        $body = @json_decode($body, true);

        if (!$body || !is_array($body)) {
            throw Exception\CommunicationException::forInvalidResponseBody($request, $response, $exception);
        }
        if (isset($body['error'])) {
            throw Exception\AuthenticationException::forErrorMessage($body, $shop, $request, $response, $exception);
        }

        $token = $shop->getToken();
        if ($token === null) {
            $token = $this->createToken();
            $shop->setToken($token);
        }

        $token->setAccessToken($body['session']);

        if ($this->tokenObjectManager !== null) {
            $this->tokenObjectManager->persist($token);
            $this->tokenObjectManager->flush();
        }
    }

    public function logout(ShopInterface $shop): void
    {
        /** @var FrontShopInterface|BasicAuthShopInterface $shop */
        Assert::isInstanceOf($shop, FrontShopInterface::class);
        Assert::isInstanceOf($shop, BasicAuthShopInterface::class);

        $shopUri = $shop->getUri();

        $authUri = $shopUri
            ->withPath($shopUri->getPath() . '/webapi/front/' . $shop->getLanguage() . '/auth/logout');

        $headers = $shop->getRequestBasicHeaders();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        $request = $this->shopClient->getHttpClient()->createRequest(
            'post',
            $authUri,
            $headers
        );

        $exception = null;

        try {
            $response = $this->shopClient->send($request);
        } catch (Exception\PermissionsException $exception) {
            $response = $exception->getHttpResponse();
        }

        $stream = $response->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        if (strlen($body) === 0) {
            throw Exception\CommunicationException::forEmptyResponseBody($request, $response, $exception);
        }
        $body = @json_decode($body, true);

        if (!$body || !is_array($body)) {
            throw Exception\CommunicationException::forInvalidResponseBody($request, $response, $exception);
        }
        if (isset($body['error'])) {
            throw Exception\AuthenticationException::forErrorMessage($body, $shop, $request, $response, $exception);
        }

        $shop->clearSessions();
        if ($this->tokenObjectManager !== null) {
            $this->tokenObjectManager->persist(null);
            $this->tokenObjectManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refresh(ShopInterface $shop): void
    {
        throw Exception\RefreshTokenException::forUnsupportedMethod($shop);
    }

    /**
     * @return TokenInterface
     */
    private function createToken(): TokenInterface
    {
        if ($this->tokenFactory !== null) {
            return $this->tokenFactory->createNew();
        }

        return new Token();
    }
}