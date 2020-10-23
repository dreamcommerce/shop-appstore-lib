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

use DateInterval;
use DateTimeZone;
use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Component\Common\Factory\DateTimeFactory;
use DreamCommerce\Component\Common\Factory\DateTimeFactoryInterface;
use DreamCommerce\Component\ShopAppstore\Api\Exception;
use DreamCommerce\Component\ShopAppstore\Api\Http\ShopClientInterface;
use DreamCommerce\Component\ShopAppstore\Info;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\Token;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use Psr\Http\Message\RequestInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

abstract class BearerAuthenticator implements AuthenticatorInterface
{
    /**
     * @var DateTimeFactoryInterface
     */
    private $dateTimeFactory;

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
     * @param DateTimeFactoryInterface|null $dateTimeFactory
     * @param ObjectManager|null $tokenObjectManager
     * @param FactoryInterface|null $tokenFactory
     */
    public function __construct(
        ShopClientInterface $shopClient,
        DateTimeFactoryInterface $dateTimeFactory = null,
        ObjectManager $tokenObjectManager = null,
        FactoryInterface $tokenFactory = null
    ) {
        $this->shopClient = $shopClient;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->tokenObjectManager = $tokenObjectManager;
        $this->tokenFactory = $tokenFactory;
    }

    /**
     * @param RequestInterface $request
     * @param ShopInterface $shop
     * @param string $exceptionClass
     *
     * @throws Exception\AuthenticationException
     * @throws Exception\CommunicationException
     */
    protected function handleRequest(RequestInterface $request, ShopInterface $shop, string $exceptionClass): void
    {
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
            throw $exceptionClass::forErrorMessage($body, $shop, $request, $response, $exception);
        }

        $token = $shop->getToken();
        if ($token === null) {
            $token = $this->createToken();
            $shop->setToken($token);
        }

        $token->setAccessToken($body['access_token']);

        $refreshToken = null;
        if (isset($body['refresh_token'])) {
            $refreshToken = $body['refresh_token'];
        }
        $token->setRefreshToken($refreshToken);

        $expiresAt = null;
        if (isset($body['expires_in'])) {
            $dateTimeFactory = $this->getDateTimeFactory();
            $expiresAt = $dateTimeFactory->createNewWithTimezone(new DateTimeZone(Info::TIMEZONE));
            $expiresAt->add(DateInterval::createFromDateString($body['expires_in'] . ' seconds'));
        }
        $token->setExpiresAt($expiresAt);

        if ($this->tokenObjectManager !== null) {
            $this->tokenObjectManager->persist($token);
            $this->tokenObjectManager->flush();
        }
    }

    /**
     * @return DateTimeFactoryInterface
     */
    private function getDateTimeFactory(): DateTimeFactoryInterface
    {
        if ($this->dateTimeFactory === null) {
            $this->dateTimeFactory = new DateTimeFactory();
        }

        return $this->dateTimeFactory;
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
