<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Exception;

use DreamCommerce\Component\ShopAppstore\Api\Validation;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ValidationException extends ApiException
{
    /**
     * @var Validation[]
     */
    private $validationMessages = array();

    /**
     * @param RequestInterface $httpRequest
     * @param ResponseInterface|null $httpResponse
     * @param Throwable|null $previous
     * @return ValidationException
     */
    public static function forResponse(RequestInterface $httpRequest, ResponseInterface $httpResponse = null, Throwable $previous = null): self
    {
        $exception = new static('Validation error', self::CODE_INVALID_RESPONSE, $previous);
        $exception->httpRequest = $httpRequest;
        $exception->httpResponse = $httpResponse;

        if($httpResponse) {
            $stream = $httpResponse->getBody();
            $stream->rewind();

            $body = $stream->getContents();
            if (strlen($body) > 0) {
                $message = @json_decode($body, true);
                if (is_array($message) && isset($message['error_description'])) {
                    $errors = explode('; ', $message['error_description']);
                    foreach($errors as $error) {
                        $exception->validationMessages[] = new Validation($error);
                    }
                }
            }
        }

        return $exception;
    }

    /**
     * @return Validation[]
     */
    public function getValidationMessages(): array
    {
        return $this->validationMessages;
    }
}