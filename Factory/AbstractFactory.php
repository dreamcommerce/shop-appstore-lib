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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException;
use DreamCommerce\Component\ShopAppstore\Model\DataInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

abstract class AbstractFactory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $resourceMap = [];

    /**
     * @var DataFactoryInterface
     */
    protected $dataFactory;

    /**
     * @param DataFactoryInterface $dataFactory
     * @param array $resourceMap
     */
    public function __construct(DataFactoryInterface $dataFactory, array $resourceMap = array())
    {
        $this->dataFactory = $dataFactory;
        $this->resourceMap = $resourceMap;
    }

    /**
     * @param string $resourceClass
     * @param string $className
     */
    public function addResourceMap(string $resourceClass, string $className)
    {
        $this->resourceMap[$resourceClass] = $className;
    }

    /**
     * @param array $resourceMap
     */
    public function setResourceMap(array $resourceMap)
    {
        $this->resourceMap = $resourceMap;
    }

    /**
     * @param array $data
     * @param DataInterface|null $container
     * @return DataInterface
     */
    public function createFromArray(array $data, DataInterface $container = null): DataInterface
    {
        if($container === null) {
            $container = $this->dataFactory->createNew();
        }

        $vals = [];
        foreach($data as $k => $v) {
            if(is_array($v)) {
                $vals[$k] = $this->createFromArray($v);
            } elseif(is_scalar($v) || is_null($v)) {
                $vals[$k] = $v;
            } else {
                throw new \Exception();
            }
        }
        $container->setData($vals);

        return $container;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array
     * @throws CommunicationException
     */
    protected function handleApiRequest(RequestInterface $request, ResponseInterface $response): array
    {
        $stream = $response->getBody();
        $stream->rewind();

        $body = $stream->getContents();
        if(strlen($body) === 0) {
            throw CommunicationException::forEmptyResponseBody($request, $response);
        }
        $body = @json_decode($body, true);

        if(!$body || !is_array($body)) {
            throw CommunicationException::forInvalidResponseBody($request, $response);
        }

        return $body;
    }
}