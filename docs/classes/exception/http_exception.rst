HttpException
=============
.. php:namespace:: DreamCommerce\Exception
.. php:class:: HttpException

An exception raised upon problem in communication layer (HTTP protocol error).

constants
*********

``LIMIT_TOO_LOW``
    specified request limit is too low
``METHOD_NOT_SUPPORTED``
    tried to perform an unsupported HTTP method
``QUOTA_EXCEEDED``
    requests quota exceeded
``REQUEST_FAILED``
    a request failed (eg. I/O)

methods
*******

.. php:method:: __construct([$message = '', [$code = 0, [$previous = null, [$headers = array(), [ $response = '']]]]])

    Method instantiates exception.

    :param string $message: exception message
    :param integer $code: error code
    :param \Exception|null $previous: a handle to the previous exception
    :param array $headers: an array with response headers

.. php:method:: getHeaders()

    Returns an array with headers returned upon exception raising.

    :rtype: array
    :returns: headers

.. php:method:: getResponse()

    Returns a raw server response that caused an exception.

    :rtype: string
    :returns: response