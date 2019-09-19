<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class MethodUnsupportedException extends ApiException
{
    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface|null $httpResponse
     * @param Throwable|null $previous
     * @return MethodUnsupportedException
     */
    public static function forResponse(RequestInterface $httpRequest, ResponseInterface $httpResponse = null, Throwable $previous = null): self
    {
        $exception = new static('Unsupported method', self::CODE_INVALID_RESPONSE, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        return $exception;
    }
}