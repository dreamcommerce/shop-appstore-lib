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
use DreamCommerce\Component\ShopAppstore\Api\Http\Middleware\SendRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use SplPriorityQueue;

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
    private $middlewares = array();

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
        $this->register(new SendRequest($httpClient));
    }

    /**
     * {@inheritdoc}
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $exception = null;

        $this->lastRequest = $request;
        $this->lastResponse = null;

        $next = function() {};

        foreach(clone $this->middlewares as $middleware) {
            $func = function(RequestInterface $request, ResponseInterface $response = null) use($middleware, $next) {
                $this->lastRequest = $request;
                $this->lastResponse = $response;
                $middleware->handle($next, $this->lastRequest, $this->lastResponse);
            };

            $next = $func;
        }

        $next($this->lastRequest);

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
        if($this->httpClient !== null) {
            return $this->httpClient;
        }

        if(self::$globalHttpClient === null) {
            if (class_exists('\\GuzzleHttp\\Client')) {
                self::$globalHttpClient = new GuzzlePsrClient(new \GuzzleHttp\Client());
            } else {
                throw new RuntimeException('Unable initialize HTTP client');
            }
        }

        return self::$globalHttpClient;
    }
}