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
use SimpleXMLElement;

final class XmlParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(ServerRequestInterface $serverRequest): array
    {
        $stream = $serverRequest->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        $object = @simplexml_load_string($body);
        if ($object === false) {
            // TODO throw exception
        }

        return $this->xml2array($object);
    }

    /**
     * @param SimpleXMLElement $object
     *
     * @return array
     */
    private function xml2array(SimpleXMLElement $object): array
    {
        $result = [];
        foreach ((array) $object as $index => $node) {
            $result[$index] = (is_object($node)) ? $this->xml2array($node) : $node;
        }

        return $result;
    }
}
