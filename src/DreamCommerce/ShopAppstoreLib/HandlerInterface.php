<?php

namespace DreamCommerce\ShopAppstoreLib;

use Psr\Log\LoggerInterface;

interface HandlerInterface
{
    const EVENT_INSTALL = 'install';
    const EVENT_UNINSTALL = 'uninstall';
    const EVENT_BILLING_INSTALL = 'billing_install';
    const EVENT_BILLING_SUBSCRIPTION = 'billing_subscription';
    const EVENT_UPGRADE = 'upgrade';

    /**
     * Checks whether handled action really exists in API
     *
     * @param $action
     * @return bool
     * @throws Exception\HandlerException
     */
    public function actionExists($action);

    /**
     * Verifies a payload against provided data hash value
     *
     * @param $payload
     * @return bool
     * @throws Exception\HandlerException
     */
    public function verifyPayload($payload);

    /**
     * Request dispatcher
     *
     * @param array|null $requestBody if null - uses $_POST
     * @throws Exception\HandlerException
     */
    public function dispatch($requestBody = null);

    /**
     * Subscribe event for an action
     *
     * @param string $event
     * @param Callable|array $handler
     * @return int current number of handlers
     * @throws Exception\HandlerException
     */
    public function subscribe($event, $handler);

    /**
     * Unsubscribes event for an action
     *
     * @param $event
     * @param Callable|array|null $handler if null - drops all handlers; if handler specified - drops only this one
     * @return bool
     * @throws Exception\HandlerException
     */
    public function unsubscribe($event, $handler = null);

    /**
     * @param ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client);

    /**
     * @return ClientInterface
     * @throws HandlerException
     */
    public function getClient();

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * @return LoggerInterface
     */
    public function getLogger();
}