Http
====
.. php:namespace:: DreamCommerce
.. php:class:: Http

A class performing HTTP requests.

Each of implemented methods returns following data set:

.. _structure:
.. code-block:: php

    [
        'headers' => [
            'Content-Type' => 'application/json'
        ],
        'data' => <\ArrayObject|string>
    ]

static methods
**************
.. php:staticmethod:: instance()

    Returns a class instance

    :returns: class instance
    :rtype: Http

.. php:staticmethod:: setRetryLimit($num)

    Sets retries count if requests quota is exceeded.

    :param integer $num: retries limit

methods
*******

.. php:method:: delete($url, [$query = array(), [$headers = array()]])

    Performs HTTP DELETE.

    :param string $url: URL
    :param array $query: query parameters (URL query string, after question mark)
    :param array $headers: additional headers to sent within request
    :rtype: array
    :returns: see: structure_

.. php:method:: get($url, [$query = array(), [$headers = array()]])

    Performs HTTP GET.

    :param string $url: URL
    :param array $query: query parameters (URL query string, after question mark)
    :param array $headers: additional headers to sent within request
    :rtype: array
    :returns: see: structure_

.. php:method:: post($url, [$body = array(), [$query = array(), [$headers = array()]]])

    Performs HTTP POST.

    :param string $url: URL
    :param string $body: request body
    :param array $query: query parameters (URL query string, after question mark)
    :param array $headers: additional headers to sent within request
    :rtype: mixed
    :returns: see: structure_

.. php:method:: put($url, [$body = array(), [$query = array(), [$headers = array()]]])

    Performs HTTP PUT.

    :param string $url: URL
    :param string $body: request body
    :param array $query: query parameters (URL query string, after question mark)
    :param array $headers: additional headers to sent within request
    :rtype: mixed
    :returns: see: structure_