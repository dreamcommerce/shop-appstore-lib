Client
======
.. php:namespace:: DreamCommerce
.. php:class:: Client

A client library allowing to perform REST-ful requests.

This class implements :php:interface:`ClientInterface`. .

adapters
********

.. toctree::
    :maxdepth: 2

    client/basic_auth
    client/bearer
    client/oauth

constants
*********

.. php:const:: ADAPTER_OAUTH

    a pointer to the :php:class:`Client\\OAuth`

.. php:const:: ADAPTER_BASIC_AUTH

    a pointer to the :php:class:`Client\\BasicAuth`

static methods
**************

.. php:staticmethod:: factory($adapter, $options = [])

    Creates client instance.

    :param string $adapter: adapter name
    :param array $options: creation options
    :rtype: ClientInterface
    :returns: client

    Globally, ``$options`` accepts following keys:

    ``entrypoint``
        shop URL
    ``namespace``
        a namespace used to find ``$adapter`` class

.. php:staticmethod:: getDefaultAdapter()

    Gets default defined adapter

    :rtype: ClientInterface|null
    :returns: client

.. php:staticmethod:: setDefaultAdapter(ClientInterface $adapter)

    Sets default defined adapter

    :param ClientInterface $adapter: adapter handle
    :rtype: void


methods
*******

.. php:method:: __construct($entrypoint, $clientId, $clientSecret)

    constructor

    :param string $exception: in case of webapi/rest is not a part of URL, it will be automatically appended
    :param string $clientId: string application ID
    :param string $clientSecret: application secret code (generated upon App Store application registration)

    Calling a constructor is adequate to perform this call:

    .. code-block:: php

        self::factory(self::ADAPTER_OAUTH, array(
            'entrypoint' => $entrypoint,
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        )


.. php:method:: getToken($authCode)

    Gets token using the AuthCode.

    :param string $authCode: authorization code, passed during installation
    :rtype: array
    :returns: an array with tokens

.. php:method:: refreshToken($refreshToken)

    Refreshes token

    :param string $refreshToken: refresh token, passed during token getting/exchange
    :rtype: array
    :returns: an array with new tokens

.. php:method:: setAccessToken($token)

    Sets an access token for current script execution. Called automatically upon exchange/refreshing of token.

    :param string $token: token

.. php:method:: setAdapter(ClientInterface $adapter)

    Sets adapter on this client.

    :param ClientInterface $adapter: adapter
    :rtype: Client
    :returns: chain

.. php:method::getAdapter()

    Gets bound adapter

    :rtype: ClientInterface
    :returns: adapter

