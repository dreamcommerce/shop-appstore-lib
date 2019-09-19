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

use DreamCommerce\Component\Common\Http\ClientInterface;
use DreamCommerce\Component\Common\Util\Sleeper;
use DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

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
     * @param ClientInterface|null $httpClient
     * @param LoggerInterface|null $logger
     * @param Sleeper|null $sleeper
     */
    public function __construct(ClientInterface $httpClient = null, LoggerInterface $logger = null, Sleeper $sleeper = null)
    {
        if($sleeper === null) {
            $sleeper = new Sleeper();
        }
        $this->sleeper = $sleeper;

        parent::__construct($httpClient, $logger);
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