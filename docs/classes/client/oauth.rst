OAuth
=====
.. php:namespace:: DreamCommerce\ShopAppstoreLib\Client
.. php:class:: OAuth

An adapter for OAuth requests.

This class implements :php:interface:`DreamCommerce\\ClientInterface`.

methods
*******

.. php:method:: __construct($options = [])

    constructor

    :param array $options: object instantiation options
    :throws: ClientOAuthException

    Available options keys:

    ``entrypoint``
        shop URL
    ``client_id``
        application identifier
    ``client_secret``
        application secret
    ``auth_code``
        authentication code used for access token exchange
    ``refresh_token``
        refresh token used for access token update

.. php:method:: refreshTokens()

    Refreshes access tokens. (implies setting ``refresh_token`` in :php:meth:`__construct` or :php:meth:`setRefreshToken`)

    :rtype: array
    :returns: new tokens


.. php:method:: getClientId()

    Gets supplied application identifier.

    :rtype: string|null
    :returns: identifier

.. php:method:: setClientId($clientId)

    Sets application identifier.

    :param string $clientId: identifier
    :rtype: OAuth
    :returns: chain

.. php:method:: getClientSecret()

    Gets supplied application secret.

    :rtype: string|null
    :returns: secret

.. php:method:: setClientSecret($clientSecret)

    Sets application secret.

    :param string $clientSecret: secret
    :rtype: OAuth
    :returns: chain

.. php:method:: getAuthCode()

    Gets supplied authentication code.

    :rtype: string
    :returns: code
    :throws: ClientException

.. php:method:: setAuthCode($authCode)

    Sets authentication code.

    :param string $authCode: code
    :rtype: OAuth
    :returns: chain

.. php:method:: getRefreshToken()

    Gets supplied refresh token.

    :rtype: string
    :returns: token
    :throws: ClientException

.. php:method:: setRefreshToken($refreshToken)

    Sets refresh token.

    :param string $refreshToken: token
    :rtype: OAuth
    :returns: chain

.. php:method:: getScopes()

    Gets granted scopes list.

    :rtype: array
    :returns: scopes

