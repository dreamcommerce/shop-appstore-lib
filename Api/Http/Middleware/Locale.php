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

class Locale implements MiddlewareInterface
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @param string $locale
     */
    public function __construct(string $locale = Info::LOCALE)
    {
        $this->locale = $locale;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(callable $next, RequestInterface $request, ResponseInterface $response = null)
    {
        $request = $request->withAddedHeader('Accept-Language', $this->locale . ';q=0.8');
        $next($request, $response);
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
