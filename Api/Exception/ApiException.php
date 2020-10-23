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

use DreamCommerce\Component\ShopAppstore\Api\Error;
use DreamCommerce\Component\ShopAppstore\Exception\ShopAppstoreException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends ShopAppstoreException
{
    const CODE_INVALID_RESPONSE = 1;

    /**
     * @var RequestInterface|null
     */
    protected $httpRequest;

    /**
     * @var ResponseInterface|null
     */
    protected $httpResponse;

    /**
     * @var Error[]
     */
    protected $errors = [];

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

    /**
     * @return Error[]
     */
    public function getErrors(): array
    {
        if ($this->httpResponse !== null) {
            $stream = $this->httpResponse->getBody();
            $stream->rewind();

            $body = $stream->getContents();
            if (strlen($body) > 0) {
                $message = @json_decode($body, true);
                if (is_array($message)) {
                    $error = $message['error'] ?? null;
                    $errorDescriptions = explode('; ', $message['error_description']);
                    foreach ($errorDescriptions as $errorDescription) {
                        $this->errors[] = new Error($error, $errorDescription);
                    }
                }
            }
        }

        return $this->errors;
    }
}
