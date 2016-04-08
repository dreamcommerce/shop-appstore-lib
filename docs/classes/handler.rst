Handler
=======
.. php:namespace:: DreamCommerce\ShopAppstoreLib
.. php:class:: Handler

It's an object for handling automatic messages from AppStore. It's event-based which allows to easily bind many handlers
to the particular event (eg. for installation handler, it's possible to bind database storing, cache purging, etc).

See :php:interface:`DreamCommerce\\ShopAppstoreLib\\HandlerInterface`.

methods
*******

.. php:method::  __construct($entrypoint, $clientId, $secret, $appStoreSecret)

    Class constructor

    :param string $entrypoint: shop URL - in case of webapi/rest is not a part of URL, it will be automatically appended
    :param string $clientId: application ID
    :param string $secret: API key
    :param string $appStoreSecret: secret code


