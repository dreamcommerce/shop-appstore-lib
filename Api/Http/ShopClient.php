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

namespace DreamCommerce\Component\ShopAppstore\Api\Http;

use DreamCommerce\Component\Common\Http\ClientInterface as HttpClientInterface;
use DreamCommerce\Component\Common\Http\GuzzleClient as GuzzlePsrClient;
use DreamCommerce\Component\ShopAppstore\Api\Exception;
use DreamCommerce\Component\ShopAppstore\Api\Http\Middleware\SendRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use SplPriorityQueue;
use Throwable;

class ShopClient implements ShopClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @var MiddlewareInterface[]|\SplPriorityQueue
     */
    private $middlewares = [];

    /**
     * @var HttpClientInterface
     */
    private static $globalHttpClient;

    /**
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->middlewares = new SplPriorityQueue();
        $this->register(new SendRequest($this->getHttpClient()), self::PRIORITY_REQUEST);
    }

    /**
     * {@inheritdoc}
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $exception = null;

        $this->lastRequest = $request;
        $this->lastResponse = null;

        $next = function (RequestInterface $request, ResponseInterface $response = null) {
            $this->lastRequest = $request;
            $this->lastResponse = $response;
        };

        foreach (clone $this->middlewares as $middleware) {
            $func = function (RequestInterface $request, ResponseInterface $response = null) use ($middleware, $next) {
                $this->lastRequest = $request;
                $this->lastResponse = $response;
                $middleware->handle($next, $this->lastRequest, $this->lastResponse);
            };

            $next = $func;
        }

        $exception = null;

        try {
            $next($this->lastRequest);
        } catch (Throwable $exception) {
            // nothing
        }

        if ($this->lastResponse === null) {
            throw Exception\CommunicationException::forBrokenConnection($request, $exception);
        }
        $this->checkResponse($exception);

        return $this->lastResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function register(MiddlewareInterface $middleware, int $priority = self::PRIORITY_NORMAL): void
    {
        $this->middlewares->insert($middleware, $priority);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient(): HttpClientInterface
    {
        if ($this->httpClient !== null) {
            return $this->httpClient;
        }

        if (self::$globalHttpClient === null) {
            if (class_exists('\\GuzzleHttp\\Client')) {
                self::$globalHttpClient = new GuzzlePsrClient(new \GuzzleHttp\Client());
            } else {
                throw new RuntimeException('Unable initialize HTTP client');
            }
        }

        return self::$globalHttpClient;
    }

    /**
     * @param Throwable|null $exception
     *
     * @throws Exception\CommunicationException
     * @throws Exception\MethodUnsupportedException
     * @throws Exception\NotFoundException
     * @throws Exception\ObjectLockedException
     * @throws Exception\PermissionsException
     * @throws Exception\ValidationException
     * @throws Exception\LimitExceededException
     * @throws Exception\NotImplementedException
     */
    private function checkResponse(Throwable $exception = null): void
    {
        $responseCode = $this->lastResponse->getStatusCode();

        switch ($responseCode) {
            case 400:
                throw Exception\ValidationException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 401:
                throw Exception\PermissionsException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 404:
                throw Exception\NotFoundException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 405:
                throw Exception\MethodUnsupportedException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 409:
                throw Exception\ObjectLockedException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 429:
                throw Exception\LimitExceededException::forResponse($this->lastRequest, $this->lastResponse, $exception);
            case 501:
                throw Exception\NotImplementedException::forResponse($this->lastRequest, $this->lastResponse, $exception);
        }

        if ($responseCode !== 200) {
            throw Exception\CommunicationException::forInvalidResponseCode($this->lastRequest, $this->lastResponse, $exception);
        }
    }
}
