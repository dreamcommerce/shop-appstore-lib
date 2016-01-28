HandlerInterface
================
.. php:namespace:: DreamCommerce
.. php:interface:: HandlerInterface

Interface specifying methods for handler modules.

constants
*********

``EVENT_INSTALL``
    install message event name
``EVENT_UNINSTALL``
    uninstall message event name
``EVENT_BILLING_INSTALL``
    application paid event name
``EVENT_BILLING_SUBSCRIPTION``
    application subscription paid event name
``EVENT_UPGRADE``
    application upgrade event name

methods
*******

.. php:method:: actionExists($action)

    Checks whether handled action is supported by library

    :param string $action: action name
    :rtype: boolean
    :throws: DreamCommerce\HandlerException

.. php:method:: verifyPayload($payload)

    Verifies provided payload

    :param array $payload: payload to verify
    :rtype: boolean
    :throws: DreamCommerce\HandlerException

.. php:method:: dispatch($requestBody = null)

    Dispatch request to desired action listener

    :param array $requestBody: request body; if null - use ``$_POST``
    :rtype: boolean
    :throws: DreamCommerce\HandlerException

.. php:method:: subscribe($event, $handler)

    Subscribes a handler to the chosen event.

    :param string $event: event type for handling by handler
    :param Callable $handler: a handler to call when subscribed event is fired. ``$handler`` will be called with
        one argument of event params. If handler returns false value, event propagation is stopped.

    Available ``$event`` values:

        - ``install`` - an application is being installed in shop
        - ``uninstall`` - an application is being uninstalled
        - ``billing_install`` - installation payment
        - ``billing_subscription`` - subscription payment

.. php:method:: unsubscribe($event, $handler = null)

    Unsubscribes from event handling.

    :param string $event: event type for handling by handler
    :param null|Callable $handler: if is ``null``, all handlers are unbound. Specifying particular handler,
        leaves alone all except chosen.

    Available ``$event`` values:

        - ``install`` - an application is being installed in shop
        - ``uninstall`` - an application is being uninstalled
        - ``billing_install`` - installation payment
        - ``billing_subscription`` - subscription payment

.. php:method:: setClient(ClientInterface $client)

    Sets client on this handler.

    :param ClientInterface $client: client
    :rtype: Client
    :returns: chain

.. php:method:: getClient()

    Gets adapter bound to the handler.

    :rtype: ClientInterface
    :returns: client

.. php:method:: getLogger()

    Get bound :php:interface:`LoggerInterface`` instance.

    :rtype: LoggerInterface|null

.. php:method:: setLogger(LoggerInterface $logger)

    Set :php:interface:`LoggerInterface`` for this client.

    :param LoggerInterface $logger: instance

