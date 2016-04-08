ClientInterface
===============
.. php:namespace:: DreamCommerce\ShopAppstoreLib
.. php:interface:: ClientInterface

Interface specifying methods for client modules.

methods
*******

.. php:method:: authenticate($force = false)

    Performs authentication based on ``AuthCode`` set earlier.

    :param boolean $force: force getting tokens ignoring already set
    :rtype: stdClass
    :returns: tokens

    A sample structure may look like:

    .. code-block:: php

        array(
            'access_token'=>'xxxxxx',
            'expires_in'=>'3600',
            'token_type'=>'bearer'
        )

.. php:method:: request(Resource $res, $method, $objectPath = null, $data = [], $query = [])

    Performs REST request

    :param Resource $res: resource to perform request against
    :param string $method: HTTP method name
    :param null|array|integer $objectPath: URL path of resource
    :param array $data: payload
    :param array $query: query string
    :rtype: mixed

.. php:method:: setHttpClient(HttpInterface $httpClient)

    Set HttpClient for client.

    :param HttpInterface $httpClient: client

.. php:method:: getHttpClient()

    Get HttpClient.

    :rtype: HttpInterface|null

.. php:method:: getLocale()

    Get current locale.

.. php:method:: setLocale($locale)

    Set messages language based on ``$locale``.

    :param string $locale: locale to set

.. php:method:: getLogger()

    Get bound :php:interface:`LoggerInterface`` instance.

    :rtype: LoggerInterface|null

.. php:method:: setLogger(LoggerInterface $logger)

    Set :php:interface:`LoggerInterface`` for this client.

    :param LoggerInterface $logger: instance

.. php:method:: setOnTokenInvalidHandler($callback = null)

    Set handler called upon invalid token exception detected.

    :param Callable|null $callback: callback

