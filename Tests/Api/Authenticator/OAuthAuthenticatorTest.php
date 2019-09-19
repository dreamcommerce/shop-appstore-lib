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

namespace DreamCommerce\Component\ShopAppstore\Tests\Api\Authenticator;

use DateTime;
use DreamCommerce\Component\ShopAppstore\Api\Authenticator\OAuthAuthenticator;
use DreamCommerce\Component\ShopAppstore\Api\Exception\RefreshTokenException;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use PHPUnit\Framework\MockObject\MockObject;

class OAuthAuthenticatorTest extends BearerAuthenticatorTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->authenticator = new OAuthAuthenticator($this->shopClient, $this->dateTimeFactory);
    }

    public function testRefreshTokenValid(): void
    {
        $accessToken = '12345';
        $refreshToken = '23456';
        $expiresIn = 125;
        $dateTime = new DateTime('2018-01-16 20:30:45');

        $this->prepareRequest([
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_in' => $expiresIn,
            'scopes' => [
                'A', 'B', 'C'
            ]
        ]);

        $shop = $this->getShop(true);
        $this->prepareValidResponse($shop, $accessToken, $refreshToken, $expiresIn, $dateTime, true);

        $this->authenticator->refresh($shop);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException::EMPTY_RESPONSE_BODY
     */
    public function testRefreshTokenEmptyBody(): void
    {
        $this->prepareRequest(); // empty response body

        $shop = $this->getShop(true);
        $this->authenticator->refresh($shop);
    }

    /**
     * @expectedException \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException
     * @expectedExceptionCode \DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException::INVALID_RESPONSE_BODY
     */
    public function testRefreshTokenInvalidBody(): void
    {
        $this->prepareRequest('test'); // invalid response body

        $shop = $this->getShop(true);
        $this->authenticator->refresh($shop);
    }

    public function testRefreshTokenFailure(): void
    {
        $code = 'error-123';
        $description = 'error description';

        $this->prepareRequest([
            'error' => $code,
            'error_description' => $description
        ]);

        $shop = $this->getShop(true);
        try {
            $this->authenticator->refresh($shop);
        } catch(RefreshTokenException $e) {
            $this->assertEquals(RefreshTokenException::CODE_ERROR_MESSAGE, $e->getCode());
            $this->assertEquals($code, $e->getErrorCode());
            $this->assertEquals($description, $e->getErrorDescription());
            $this->assertEquals($shop, $e->getShop());

            return;
        }

        $this->fail('Never happen !');
    }


    protected function prepareValidResponse(ShopInterface $shop, string $accessToken, ?string $refreshToken, int $expiresIn, DateTime $dateTime, bool $isRefresh = false)
    {
        if(!$isRefresh) {
            /** @var ShopInterface|MockObject $shop */
            $shop->expects($this->once())
                ->method('setAuthCode')
                ->willReturnCallback(function ($fAuthCode) {
                    $this->assertNull($fAuthCode);
                });
        }

        parent::prepareValidResponse($shop, $accessToken, $refreshToken, $expiresIn, $dateTime, $isRefresh);
    }

    protected function getShop(bool $isRefresh = false): ShopInterface
    {
        $application = $this->getMockBuilder(ApplicationInterface::class)->getMock();
        $application->expects($this->once())
            ->method('getAppId')
            ->willReturn('5555');

        $application->expects($this->once())
            ->method('getAppSecret')
            ->willReturn('4444');

        /** @var ShopInterface|MockObject $shop */
        $shop = $this->getMockBuilder(OAuthShopInterface::class)->getMock();
        if(!$isRefresh) {
            $shop->expects($this->once())
                ->method('getAuthCode')
                ->willReturn('test');
        }

        $shop->expects($this->once())
            ->method('getApplication')
            ->willReturn($application);

        $shop->expects($this->once())
            ->method('getUri')
            ->willReturn($this->getUri());

        return $shop;
    }
}