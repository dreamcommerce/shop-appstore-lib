BasicAuth
=========
.. php:namespace:: DreamCommerce\Client
.. php:class:: BasicAuth

A client library allowing to perform REST-ful requests using ``Basic`` authentication method.

This class implements :php:interface:`DreamCommerce\\ClientInterface`.

constants
*********

``HTTP_ERROR_AUTH_FAILURE``
    Authentication failure
``HTTP_ERROR_AUTH_IP_NOT_ALLOWED``
    Failure due to invalid IP being used
``HTTP_ERROR_AUTH_WEBAPI_ACCESS_DENIED``
    Missing WebAPI credentials

methods
*******

.. php:method:: __construct($options = [])

    constructor

    :param array $options: object instantiation options
    :throws: ClientBasicAuthException

    Available options keys:

    ``username``
        auth user name

    ``password``
        auth password

.. php:method:: getUsername()

    Get already set user name.

.. php:method:: setUsername($username)

    Set user name for request.

    :param string $username: user name

.. php:method:: getPassword()

    Get already set password.

.. php:method:: setPassword($password)

    Set password for request.

    :param string $password: password

