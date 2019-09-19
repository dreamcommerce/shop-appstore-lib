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
use DreamCommerce\Component\Common\Http\LoggerInterface as HttpLoggerInterface;
use DreamCommerce\Component\Common\Util\Sleeper;
use DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class AwaitShopClient extends ShopClient
{
    /**
     * @var int
     */
    private $retryLimit = 5;

    /**
     * @var Sleeper
     */
    private $sleeper;

    /**
     * @param HttpClientInterface|null $httpClient
     * @param HttpLoggerInterface|null $httpLogger
     * @param Sleeper|null $sleeper
     */
    public function __construct(HttpClientInterface $httpClient = null, HttpLoggerInterface $httpLogger = null, Sleeper $sleeper = null)
    {
        if($sleeper === null) {
            $sleeper = new Sleeper();
        }
        $this->sleeper = $sleeper;

        parent::__construct($httpClient, $httpLogger);
    }

    /**
     * @return int
     */
    public function getRetryLimit(): int
    {
        return $this->retryLimit;
    }

    /**
     * @param int $retryLimit
     * @return void
     */
    public function setRetryLimit(int $retryLimit): void
    {
        $this->retryLimit = $retryLimit;
    }

    /**
     * {@inheritdoc}
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $counter = $this->retryLimit;

        /** @var ResponseInterface $response */
        $response = null;

        while($counter--) {
            try {
                $response = parent::send($request);
                break;
            } catch (LimitExceededException $exception) {
                if($exception->getCode() === LimitExceededException::CODE_EXCEEDED_API_CALLS) {
                    if($counter <= 0) {
                        throw LimitExceededException::forExceededMaxApiRetries($request, $this->retryLimit, $exception);
                    }
                    $response = $exception->getHttpResponse();
                    $this->sleeper->sleep($exception->getRetryAfter());
                } else {
                    throw $exception;
                }
            }
        }

        return $response;
    }
}