Handler
=======
.. php:namespace:: DreamCommerce
.. php:class:: Handler

It's an object for handling automatic messages from AppStore. It's event-based which allows to easily bind many handlers
to the particular event (eg. for installation handler, it's possible to bind database storing, cache purging, etc).

methods
*******

.. php:method::  __construct($entrypoint, $clientId, $secret, $appStoreSecret)

    Class constructor

    :param string $entrypoint: shop URL - in case of webapi/rest is not a part of URL, it will be automatically appended
    :param string $clientId: application ID
    :param string $secret: API key
    :param string $appStoreSecret: secret code

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