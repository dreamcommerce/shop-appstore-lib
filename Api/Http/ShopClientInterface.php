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
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ShopClientInterface
{
    const PRIORITY_MIN = -1000;
    const PRIORITY_LOW = -100;
    const PRIORITY_NORMAL = 0;
    const PRIORITY_HIGH = 100;
    const PRIORITY_MAX = 1000;

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface;

    /**
     * @param MiddlewareInterface $middleware
     * @param int $priority
     */
    public function register(MiddlewareInterface $middleware, int $priority = self::PRIORITY_NORMAL): void;

    /**
     * @return RequestInterface|null
     */
    public function getLastRequest(): ?RequestInterface;

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface;

    /**
     * @return HttpClientInterface
     */
    public function getHttpClient(): HttpClientInterface;
}