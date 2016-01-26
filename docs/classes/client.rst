Client
======
.. php:namespace:: DreamCommerce
.. php:class:: Client

A client library allowing to perform REST-ful requests.

static methods
**************

.. php:staticmethod:: getError(Exception $exception)

    Returns an error message of specified exception, layer-independent.

    :param Exception $exception: an exception which is a source for error message
    :rtype: string
    :returns: error message


methods
*******

.. php:method:: __construct($entrypoint, $clientId, $clientSecret)

    constructor

    :param string $exception: in case of webapi/rest is not a part of URL, it will be automatically appended
    :param string $clientId: string application ID
    :param string $clientSecret: application secret code (generated upon App Store application registration)


.. php:method:: __get($resource)

    Returns resource object by name

    :param string $resource: resource name
    :rtype: resource

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

.. php:method:: request($res, $method, $objectPath = null, $data = [], $query = [])

    Performs a request to the server

    :param Resource $res: resource to perform request on
    :param string $method: ``GET/POST/PUT/DELETE``
    :param null|string|array $objectPath: resource path, eg. ``object/1/something``. It can be also an array - then class will automatically glue it with ``/``.
    :param array $data: data to pass with request
    :param array $query: query string
    :returns: request response
    :rtype: mixed

.. php:method:: setAccessToken($token)

    Sets an access token for current script execution. Called automatically upon exchange/refreshing of token.

    :param string $token: token

