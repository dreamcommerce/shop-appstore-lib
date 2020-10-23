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

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\BaseOperation;
use DreamCommerce\Component\ShopAppstore\Exception\ShopAppstoreException;
use Throwable;

class BulkException extends ShopAppstoreException
{
    const CODE_UNSUPPORTED_OPERATION = 1;
    const CODE_MAX_NUMBER_OF_CALLS_EXCEEDED = 2;

    /**
     * @var BaseOperation|null
     */
    private $operation;

    /**
     * @param BaseOperation $operation
     * @param Throwable|null $previous
     *
     * @return BulkException
     */
    public static function forUnsupportedOperation(BaseOperation $operation, Throwable $previous = null): self
    {
        $exception = new self('Unsupported operation', self::CODE_UNSUPPORTED_OPERATION, $previous);
        $exception->operation = $operation;

        return $exception;
    }

    /**
     * @param BaseOperation $operation
     * @param Throwable|null $previous
     *
     * @return BulkException
     */
    public static function forExceedMaxNumberOfCalls(BaseOperation $operation, Throwable $previous = null): self
    {
        $exception = new self('The maximum number of calls exceeded', self::CODE_MAX_NUMBER_OF_CALLS_EXCEEDED, $previous);
        $exception->operation = $operation;

        return $exception;
    }

    /**
     * @return BaseOperation|null
     */
    public function getOperation(): ?BaseOperation
    {
        return $this->operation;
    }
}
