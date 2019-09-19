<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AuthenticationException extends ApiException
{
    const CODE_ERROR_MESSAGE = 10;

    /**
     * @var ShopInterface
     */
    private $shop;

    /**
     * @var string|null
     */
    private $errorCode;

    /**
     * @var string|null
     */
    private $errorDescription;

    /**
     * @param array $body
     * @param ShopInterface $shop
     * @param RequestInterface $httpRequest
     * @param ResponseInterface $httpResponse
     * @param Throwable|null $previous
     * @return AuthenticationException
     */
    public static function forErrorMessage(array $body, ShopInterface $shop, RequestInterface $httpRequest, ResponseInterface $httpResponse, Throwable $previous = null): self
    {
        $exception = new self('Authentication failed', self::CODE_ERROR_MESSAGE, $previous);
        $exception->shop = $shop;
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        if(isset($body['error'])) {
            $exception->errorCode = $body['error'];
        }
        if(isset($body['error_description'])) {
            $exception->errorDescription = $body['error_description'];
        }

        return $exception;
    }

    /**
     * @return ShopInterface|null
     */
    public function getShop(): ?ShopInterface
    {
        return $this->shop;
    }

    /**
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * @return string|null
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }
}