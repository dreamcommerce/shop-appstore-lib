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

namespace DreamCommerce\Component\ShopAppstore\Webhook\Parser;

use Psr\Http\Message\ServerRequestInterface;

final class JsonParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(ServerRequestInterface $serverRequest): array
    {
        $stream = $serverRequest->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        $body = @json_decode($body, true);
        if ($body === false) {
            // TODO throw exception
        }

        return $body;
    }
}
