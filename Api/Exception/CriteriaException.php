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

use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Exception\ShopAppstoreException;
use Throwable;

class CriteriaException extends ShopAppstoreException
{
    const CODE_INVALID_PAGE_NUMBER = 1;
    const CODE_MAX_NUMBER_OF_ITEMS_EXCEEDED = 2;

    /**
     * @var Criteria|null
     */
    private $criteria;

    /**
     * @param Criteria $criteria
     * @param Throwable|null $previous
     *
     * @return CriteriaException
     */
    public static function forInvalidPageNumber(Criteria $criteria, Throwable $previous = null): self
    {
        $exception = new self('The current page cannot be smaller than 1', self::CODE_INVALID_PAGE_NUMBER, $previous);
        $exception->criteria = $criteria;

        return $exception;
    }

    /**
     * @param Criteria $criteria
     * @param Throwable|null $previous
     *
     * @return CriteriaException
     */
    public static function forExceedMaxNumberOfItems(Criteria $criteria, Throwable $previous = null): self
    {
        $exception = new self('The maximum number of items exceeded', self::CODE_MAX_NUMBER_OF_ITEMS_EXCEEDED, $previous);
        $exception->criteria = $criteria;

        return $exception;
    }

    /**
     * @return Criteria|null
     */
    public function getCriteria(): ?Criteria
    {
        return $this->criteria;
    }
}
