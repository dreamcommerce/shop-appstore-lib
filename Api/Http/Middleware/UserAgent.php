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

namespace DreamCommerce\Component\ShopAppstore\Api\Http\Middleware;

use DreamCommerce\Component\ShopAppstore\Api\Http\MiddlewareInterface;
use DreamCommerce\Component\ShopAppstore\Info;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserAgent implements MiddlewareInterface
{
    /**
     * @var string
     */
    private $userAgent;

    /**
     * @param string $userAgent
     */
    public function __construct(string $userAgent = Info::HTTP_USER_AGENT)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(callable $next, RequestInterface $request, ResponseInterface $response = null)
    {
        $request = $request->withAddedHeader('User-Agent', $this->userAgent);
        $next($request, $response);
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }
}