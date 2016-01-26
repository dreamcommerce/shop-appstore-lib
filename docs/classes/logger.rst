Logger
======
.. php:namespace:: DreamCommerce
.. php:class:: Logger

A class performing simple messages logging.

static methods
**************

.. php:staticmethod:: __callStatic($name, $args)

    calls static log method using $name as priority name and $args[0] as message

    :param string $name: magic method name used as priority name
    :param array $args: arguments passed to magic method, $args[0] is treated as log message

    Messages can be passed to simple logger class using multiple priorities:

    .. code-block:: php

        \DreamCommerce\Logger::debug("debug message");
        \DreamCommerce\Logger::info("informational message");
        \DreamCommerce\Logger::notice("notice message");
        \DreamCommerce\Logger::warning("warning message");
        \DreamCommerce\Logger::error("error message");
        \DreamCommerce\Logger::critical("critical message");
        \DreamCommerce\Logger::alert("alert message");
        \DreamCommerce\Logger::emergency("emergency message");

methods
*******

.. php:method:: log($message, $lvl = self::DEBUG)

    Logs message to defined stream.

    :param string $message: log message
    :param string $lvl: priority

    The stream can be set by defining ``DREAMCOMMERCE_LOG_FILE`` constant

    ====== =====================================================================
    value  meaning
    ====== =====================================================================
    false  logging is disabled
    string file path or stream (i.e. ``php://stdout``, ``logs/application.log``)
    ====== =====================================================================

    You can define the constant in your source code:

    .. code-block:: php

        define('DREAMCOMMERCE_LOG_FILE', "php://stdout");

    By default, all the messages are added with debug priority. All those messages are by default filtered out,
    due to disabled debug mode. Debugging may be enabled by defining ``DREAMCOMMERCE_DEBUG`` constant.

    ===== =======================
    value meaning
    ===== =======================
    false debug mode is disabled
    true  debug mode is enabled
    ===== =======================

    You can define the constant in your source code:

    .. code-block:: php

        define('DREAMCOMMERCE_DEBUG', true);