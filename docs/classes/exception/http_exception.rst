HttpException
=============
.. php:namespace:: DreamCommerce\ShopAppstoreLib\Exception
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
``MALFORMED_RESULT``
    cannot parse server response

methods
*******

.. php:method:: __construct([$message = ''[, $code = 0[, $previous = null[, $method = null[, $url = null[, $headers = array()[, $query = array()[, $body = null[, $response = ''[, $responseHeaders = array()]]]]]]]]])

    Method instantiates exception.

    :param string $message: exception message
    :param integer $code: error code
    :param \Exception|null $previous: a handle to the previous exception
    :param string $method: HTTP method name
    :param string $url: URL to entrypoint that caused failure
    :param array $headers: an array with response headers
    :param array $query: query string parameters
    :param array $body: body parameters
    :param mixed $response: server response
    :param array $responseHeaders: server response headers

.. php:method:: getHeaders()

    Returns an array with headers returned upon exception raising.

    :rtype: array
    :returns: headers

.. php:method:: getResponse()

    Returns a raw server response that caused an exception.

    :rtype: string
    :returns: response

.. php:method:: getMethod()

    Returns HTTP method name.

    :rtype: string
    :returns: method name

.. php:method:: getUrl()

    Returns URL.

    :rtype: string
    :returns: URL

.. php:method:: getBody()

    Returns body used for request.

    :rtype: mixed
    :returns: body

.. php:method:: getQuery()

    Returns query string parameters.

    :rtype: array
    :returns: query string

.. php:method:: getResponseHeaders()

    Get returned server response headers.

    :rtype: array
    :returns: response headers

.. php:method:: __toString()

    Serializes exception to loggable form.

    :rtype: array
    :returns: string-serialized exception data

