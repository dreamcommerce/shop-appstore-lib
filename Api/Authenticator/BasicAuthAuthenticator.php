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

use DreamCommerce\Component\ShopAppstore\Api\Exception\AuthenticationException;
use DreamCommerce\Component\ShopAppstore\Api\Exception\RefreshTokenException;
use DreamCommerce\Component\ShopAppstore\Model\BasicAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Webmozart\Assert\Assert;

final class BasicAuthAuthenticator extends BearerAuthenticator
{
    /**
     * Authentication failure
     */
    const HTTP_ERROR_AUTH_FAILURE = "auth_failure";

    /**
     * Failure due to invalid IP being used
     */
    const HTTP_ERROR_AUTH_IP_NOT_ALLOWED = 'auth_ip_not_allowed';

    /**
     * Failure due to missing WebAPI credentials
     */
    const HTTP_ERROR_AUTH_WEBAPI_ACCESS_DENIED = 'auth_webapi_access_denied';

    /**
     * {@inheritdoc}
     */
    public function authenticate(ShopInterface $shop): void
    {
        /** @var BasicAuthShopInterface $shop */
        Assert::isInstanceOf($shop, BasicAuthShopInterface::class);

        $shopUri = $shop->getUri();

        $query = [
            'client_id' => $shop->getUsername(),
            'client_secret' => $shop->getPassword()
        ];

        $authUri = $shopUri
            ->withPath($shopUri->getPath() . '/webapi/rest/auth')
            ->withQuery(http_build_query($query, '', '&'));

        $request = $this->shopClient->getHttpClient()->createRequest(
            'post',
            $authUri,
            [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        );

        $this->handleRequest($request, $shop, AuthenticationException::class);
    }

    /**
     * {@inheritdoc}
     */
    public function refresh(ShopInterface $shop): void
    {
        throw RefreshTokenException::forUnsupportedMethod($shop);
    }
}