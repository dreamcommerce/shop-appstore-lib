Http
====
.. php:namespace:: DreamCommerce\ShopAppstoreLib
.. php:class:: Http

A class performing HTTP requests.

This class implements :php:interface:`HttpInterface`.

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

.. php:method:: parseHeaders($src)

    Parse ``$http_response_header`` to more readable form.

    :param array $src: source headers data
    :rtype: array
    :returns: parsed headers

    Returned array looks like:

    .. code-block:: php

        array(
            'Code'=>404,
            'Status'=>'Not Found'
            'X-Header1'=>'value',
            'X-Header2'=>'value'
        )

.. php:method:: setSkipSsl($status)

    Tell PHP to skip SSL certificates validation.

    :param boolean $status: skip?
    :rtype: void
