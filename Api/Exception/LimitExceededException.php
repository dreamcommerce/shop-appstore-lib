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

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class LimitExceededException extends ApiException
{
    const CODE_EXCEEDED_API_CALLS = 10;
    const CODE_EXCEEDED_MAX_API_RETRIES = 11;

    /**
     * @var int|null
     */
    private $retryAfter;

    /**
     * @var int|null
     */
    private $maxAttempts;

    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface $httpResponse
     * @param Throwable|null $previous
     *
     * @return LimitExceededException
     */
    public static function forResponse(RequestInterface $httpRequest, ResponseInterface $httpResponse, Throwable $previous = null): self
    {
        $exception = new self('The API calls has been exceeded', self::CODE_EXCEEDED_API_CALLS, $previous);
        $responseHeaders = $httpResponse->getHeaders();

        $exception->retryAfter = isset($responseHeaders['Retry-After']) ? (int) $responseHeaders['Retry-After'][0] : 1;
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        return $exception;
    }

    /**
     * @param RequestInterface $httpRequest
     * @param int|null $maxAttempts
     * @param Throwable|null $previous
     *
     * @return LimitExceededException
     */
    public static function forExceededMaxApiRetries(RequestInterface $httpRequest, ?int $maxAttempts, Throwable $previous = null): self
    {
        $exception = new self('The maximum number of attempts to retry HTTP query has been exceeded', self::CODE_EXCEEDED_MAX_API_RETRIES, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->maxAttempts = $maxAttempts;

        return $exception;
    }

    /**
     * @return int|null
     */
    public function getRetryAfter(): ?int
    {
        return $this->retryAfter;
    }

    /**
     * @return int|null
     */
    public function getMaxAttempts(): ?int
    {
        return $this->maxAttempts;
    }
}
