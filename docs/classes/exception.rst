Exception
=========
.. php:namespace:: DreamCommerce
.. php:class:: Exception

static methods
**************

.. php:staticmethod:: setLogger(LoggerInterface $logger)

    Set own logger for exceptions.

    :param LoggerInterface $logger: instance

.. php:staticmethod:: getLogger()

    Get logger for exceptions. If none was defined, instantiate and return :php:class:`DreamCommerce\\Logger`.

    :rtype: LoggerInterface

derived classes
***************

.. toctree::
    :maxdepth: 2

    exception/client_basic_auth_exception
    exception/client_exception
    exception/client_oauth_exception
    exception/handler_exception
    exception/http_exception
    exception/resource_exception

