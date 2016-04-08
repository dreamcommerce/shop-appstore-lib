Bearer
======
.. php:namespace:: DreamCommerce\ShopAppstoreLib\Client
.. php:class:: Bearer

An abstract client class for most of REST operations.

This class implements :php:interface:`DreamCommerce\\ShopAppstoreLib\\ClientInterface`.

constants
*********

``HTTP_ERROR_INVALID_REQUEST``
    invalid HTTP request
``HTTP_ERROR_UNAUTHORIZED_CLIENT``
    connection lacks from authorization data
``HTTP_ERROR_ACCESS_DENIED``
    access for specified client is denied
``HTTP_ERROR_UNSUPPORTED_RESPONSE_TYPE``
    response type is unsupported
``HTTP_ERROR_UNSUPPORTED_GRANT_TYPE``
    grant is unsupported
``HTTP_ERROR_INVALID_SCOPE``
    scope is invalid
``HTTP_ERROR_INVALID_GRANT``
    grant is invalid
``HTTP_ERROR_INSUFFICIENT_SCOPE``
    current token has insufficient permissions
``HTTP_ERROR_REDIRECT_URI_MISMATCH``
    problem with redirection
``HTTP_ERROR_SERVER_ERROR``
    internal server error occurred
``HTTP_ERROR_TEMPORARILY_UNAVAILABLE``
    server returned 5xx error

methods
*******

.. php:method:: __construct($options = [])

    constructor

    :param array $options: object instantiation options
    :throws: ClientException

    Available options keys:

    ``entrypoint``
        shop URL

.. php:method:: getAccessToken()

    Get already set token.

    :rtype: string

.. php:method:: setAccessToken($token)

    Set token.

    :param string $token: token

.. php:method:: getExpiresIn()

    Get token expiration.

    :rtype: string

.. php:method:: setExpiresIn($expiresIn)

    Set token expiration

    :param integer $expiresIn: expiration

