<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use DreamCommerce\Component\ShopAppstore\Exception\ShopAppstoreException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends ShopAppstoreException
{
    const CODE_INVALID_RESPONSE     = 1;

    /**
     * @var RequestInterface|null
     */
    protected $httpRequest;

    /**
     * @var ResponseInterface|null
     */
    protected $httpResponse;

    /**
     * @return RequestInterface|null
     */
    public function getHttpRequest(): ?RequestInterface
    {
        return $this->httpRequest;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getHttpResponse(): ?ResponseInterface
    {
        return $this->httpResponse;
    }
}