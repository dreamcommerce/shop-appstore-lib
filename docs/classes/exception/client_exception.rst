ClientException
===============
.. php:namespace:: DreamCommerce\Exception
.. php:class:: ClientException

An exception raised upon :php:class:`DreamCommerce\\Client` library error.

constants
*********

``API_ERROR``
    an server API error occured - check error message
``ENTRYPOINT_URL_INVALID``
    invalid shop URL
``METHOD_NOT_SUPPORTED``
    tried to perform an unsupported method (other than ``GET/POST/PUT/DELETE``)
``UNKNOWN_ERROR``
    unknown error
``PARAMETER_NOT_SPECIFIED``
    required parameter has not been specified

methods
*******

.. php:method:: getHttpError()

    Get error message from HTTP request failuer

    :rtype: string
    :returns: error

