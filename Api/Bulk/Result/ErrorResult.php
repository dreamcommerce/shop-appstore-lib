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

namespace DreamCommerce\Component\ShopAppstore\Api\Bulk\Result;

use DreamCommerce\Component\ShopAppstore\Api\Bulk\Operation\BaseOperation;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

class ErrorResult extends BaseResult
{
    const ERROR_OPERATION_OUT_OF_TIME = 'OPERATION_OUT_OF_TIME';
    const ERROR_MEMORY_LIMIT = 'MEMORY_LIMIT';
    const ERROR_MAX_BULK_ITEMS_EXCEEDED = 'MAX_BULK_ITEMS_EXCEEDED';

    /**
     * @var int
     */
    private $code;

    /**
     * @var string|null
     */
    private $error;

    /**
     * @var string|null
     */
    private $errorDescription;

    /**
     * @param BaseOperation $operation
     * @param ShopInterface $shop
     * @param int $code
     * @param string|null $error
     * @param string|null $errorDescription
     */
    public function __construct(
        BaseOperation $operation,
        ShopInterface $shop,
        int $code,
        string $error = null,
        string $errorDescription = null
    ) {
        $this->code = $code;
        $this->error = $error;
        $this->errorDescription = $errorDescription;

        parent::__construct($operation, $shop);
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return string|null
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }
}
