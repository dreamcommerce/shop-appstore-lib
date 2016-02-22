HttpInterface
=============
.. php:namespace:: DreamCommerce
.. php:interface:: HttpInterface

Interface specifying methods for HTTP communication layer.

Each of implemented methods returns following data set:

.. _structure:
.. code-block:: php

    array(
        'headers' => (
            'Content-Type' => 'application/json'
        ),
        'data' => <\ArrayObject|string>
    )

methods
*******

.. php:method:: getLogger()

    Get bound :php:interface:`LoggerInterface`` instance.

    :rtype: LoggerInterface|null

.. php:method:: setLogger(LoggerInterface $logger)

    Set :php:interface:`LoggerInterface`` for this client.

    :param LoggerInterface $logger: instance


.. php:method:: delete($url, [$query = array(), [$headers = array()]])

    Performs HTTP DELETE.

    :param string $url: URL
    :param array $query: query parameters (URL query string, after question mark)
    :param array $headers: additional headers to sent within request
    :rtype: array
    :returns: see: structure_

.. php:method:: head($url, [$query = array(), [$headers = array()]])

    Performs HTTP HEAD.

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

.. php:method:: getLogger()

    Get bound :php:interface:`LoggerInterface`` instance.

    :rtype: LoggerInterface|null

.. php:method:: setLogger(LoggerInterface $logger)

    Set :php:interface:`LoggerInterface`` for this client.

    :param LoggerInterface $logger: instance

