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
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface;

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void;

    /**
     * @return string
     */
    public function getLocale(): string;

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