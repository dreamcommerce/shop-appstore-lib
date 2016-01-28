ResourceException
=================
.. php:namespace:: DreamCommerce\Exception
.. php:class:: ResourceException

An exception raised upon problems with data manipulation, eg. invalid parameters.

constants
*********

``MALFORMED_RESPONSE``
    server response is not parseable
``CLIENT_ERROR``
    client error library occurred (you can reach client exception using ``getPrevious()`` method)
``LIMIT_BEYOND_RANGE``
    a limit of maximum simultaneous connections is incorrectly specified
``FILTERS_NOT_SPECIFIED``
    empty filters specified
``ORDER_NOT_SUPPORTED``
    tried to sort data by non-existing/not supported field
``INVALID_PAGE``
    specified results page is beyond the pages count

