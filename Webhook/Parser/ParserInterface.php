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

interface ParserInterface
{
    public const TYPE_XML   = 'text/xml';
    public const TYPE_JSON  = 'application/json';

    public const ALL_TYPES = [
        self::TYPE_XML,
        self::TYPE_JSON
    ];

    /**
     * @param ServerRequestInterface $serverRequest
     * @return array
     */
    public function parse(ServerRequestInterface $serverRequest): array;
}