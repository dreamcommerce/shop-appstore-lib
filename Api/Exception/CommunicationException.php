<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class CommunicationException extends ApiException
{
    const BROKEN_CONNECTION         = 10;
    const INVALID_RESPONSE_CODE     = 11;
    const EMPTY_RESPONSE_BODY       = 12;
    const INVALID_RESPONSE_BODY     = 13;
    const INVALID_REQUEST_BODY      = 14;

    /**
     * @var array
     */
    private $requestBody;

    /**
     * @param RequestInterface $httpRequest
     * @param Throwable|null $previous
     * @return CommunicationException
     */
    public static function forBrokenConnection(RequestInterface $httpRequest, Throwable $previous = null): self
    {
        $exception = new self('The connection has been broken', self::BROKEN_CONNECTION, $previous);
        $exception->httpRequest = $httpRequest;

        return $exception;
    }

    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface $httpResponse
     * @param Throwable|null $previous
     * @return CommunicationException
     */
    public static function forInvalidResponseCode(RequestInterface $httpRequest, ResponseInterface $httpResponse, Throwable $previous = null): self
    {
        $exception = new self('Unexpected response code', self::INVALID_RESPONSE_CODE, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        return $exception;
    }

    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface $httpResponse
     * @param Throwable|null $previous
     * @return CommunicationException
     */
    public static function forEmptyResponseBody(RequestInterface $httpRequest, ResponseInterface $httpResponse, Throwable $previous = null): self
    {
        $exception = new self('Response body is empty', self::EMPTY_RESPONSE_BODY, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        return $exception;
    }

    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface $httpResponse
     * @param Throwable|null $previous
     * @return CommunicationException
     */
    public static function forInvalidResponseBody(RequestInterface $httpRequest, ResponseInterface $httpResponse, Throwable $previous = null): self
    {
        $exception = new self('Invalid response body', self::INVALID_RESPONSE_BODY, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        return $exception;
    }

    /**
     * @param array $requestBody
     * @param Throwable|null $previous
     * @return CommunicationException
     */
    public static function forInvalidRequestBody(array $requestBody, Throwable $previous = null): self
    {
        $exception = new self('Invalid request body', self::INVALID_REQUEST_BODY, $previous);
        $exception->requestBody = $requestBody;

        return $exception;
    }
}