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

use DreamCommerce\Component\Common\Util\Sleeper;
use DreamCommerce\Component\ShopAppstore\Api\Exception\LimitExceededException;
use DreamCommerce\Component\ShopAppstore\Api\Http\MiddlewareInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AwaitConnection implements MiddlewareInterface
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
     * @param Sleeper|null $sleeper
     */
    public function __construct(Sleeper $sleeper = null)
    {
        if($sleeper === null) {
            $sleeper = new Sleeper();
        }
        $this->sleeper = $sleeper;
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
    public function handle(callable $next, RequestInterface $request, ResponseInterface $response = null)
    {
        $counter = $this->retryLimit;

        while($counter--) {
            try {
                $next($request, $response);
            } catch (LimitExceededException $exception) {
                if ($exception->getCode() === LimitExceededException::CODE_EXCEEDED_API_CALLS) {
                    if ($counter <= 0) {
                        throw LimitExceededException::forExceededMaxApiRetries($request, $this->retryLimit, $exception);
                    }
                    $this->sleeper->sleep($exception->getRetryAfter());
                } else {
                    throw $exception;
                }
            }
        }
    }
}