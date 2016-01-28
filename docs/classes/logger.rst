Logger
======
.. php:namespace:: DreamCommerce
.. php:class:: Logger

A class performing simple messages logging.

This class implements `PSR-3 Logger Interface <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md>`_.

methods
*******

.. php:method:: log($level, $message[, $context = []])

    Logs message to defined stream.

    :param string $level: priority
    :param string $message: log message
    :param array $context: logging context

    The target stream can be set by defining ``DREAMCOMMERCE_LOG_FILE``

    You can define the constant in your source code:

    .. code-block:: php

        define('DREAMCOMMERCE_LOG_FILE', "php://stdout");

    By default, all messages are added with debug priority. All those messages are by default filtered out,
    due to disabled debug mode.

    Debugging may be enabled by defining ``DREAMCOMMERCE_DEBUG`` constant and setting its value to ``true``.

    You can define the constant in your source code:

    .. code-block:: php

        define('DREAMCOMMERCE_DEBUG', true);

