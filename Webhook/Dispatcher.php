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

namespace DreamCommerce\Component\ShopAppstore\Webhook;

use DreamCommerce\Component\Common\Exception\NotDefinedException;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Repository\ShopRepositoryInterface;
use DreamCommerce\Component\ShopAppstore\Webhook\Parser\ParserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sylius\Component\Registry\ServiceRegistryInterface;
use Webmozart\Assert\Assert;

final class Dispatcher implements DispatcherInterface
{
    /**
     * @var ListenerInterface[]
     */
    private $listeners = [];

    /**
     * @var ServiceRegistryInterface
     */
    private $parserRegistry;

    /**
     * @var ShopRepositoryInterface
     */
    private $shopRepository;

    /**
     * @param ServiceRegistryInterface $parserRegistry
     * @param ShopRepositoryInterface $shopRepository
     */
    public function __construct(ServiceRegistryInterface $parserRegistry, ShopRepositoryInterface $shopRepository)
    {
        $this->parserRegistry = $parserRegistry;
        $this->shopRepository = $shopRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(ServerRequestInterface $serverRequest, ApplicationInterface $application = null): void
    {
        $headers = $this->checkRequest($serverRequest);

        if ($application === null) {
            $shop = $this->shopRepository->findOneByUri($headers['X-Shop-Domain']);
        } else {
            $shop = $this->shopRepository->findOneByUriAndApplication($headers['X-Shop-Domain'], $application);
        }

        if ($shop === null) {
            // TODO throw exception
        }

        if (!$this->parserRegistry->has($headers['Content-Type'])) {
            // TODO throw exception
        }

        /** @var ParserInterface $parser */
        $parser = $this->parserRegistry->get($headers['Content-Type']);
        $data = $parser->parse($serverRequest);

        // TODO
    }

    /**
     * {@inheritdoc}
     */
    public function registerListener(ListenerInterface $listener, $actions): void
    {
        if (!is_array($actions)) {
            $actions = [$actions];
        }

        foreach ($actions as $action) {
            Assert::string($action);
            Assert::oneOf($action, DispatcherInterface::ALL_ACTIONS);

            if (!isset($this->listeners[$action])) {
                $this->listeners[$action] = [];
            }

            $this->listeners[$action][] = $listener;
        }
    }

    private function checkRequest(ServerRequestInterface $serverRequest): array
    {
        $names = [
            'X-Shop-Version', 'X-Shop-Domain', 'X-Shop-License', 'X-Webhook-Id', 'X-Webhook-Name',
            'X-Webhook-SHA1', 'Content-Type',
        ];
        $headers = [];

        foreach ($names as $name) {
            if (!$serverRequest->hasHeader($name)) {
                throw NotDefinedException::forParameter($name);
            }

            $headers[$name] = $serverRequest->getHeader($name)[0];
        }

        // TODO check hash

        return $headers;
    }
}
