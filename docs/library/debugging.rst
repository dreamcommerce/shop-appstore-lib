Debugging
=========

SDK raises errors using exceptions. Explore library exceptions: :ref:`classes-list`.

Debug mode
**********

SDK allows to activate debug mode. Its purpose is to log all requests, responses and headers.

The debugging may be enabled by defining ``DREAMCOMMERCE_DEBUG`` constant.

======= =======================
value	meaning
======= =======================
false	debug mode is disabled
true	debug mode is enabled
======= =======================

You can define the constant in your source code:

.. code-block:: php

    define('DREAMCOMMERCE_DEBUG', true);

Logging messages
****************

SDK allows to log all messages to stream.

The log file may be set by defining ``DREAMCOMMERCE_LOG_FILE`` constant.

======= ==========================================================================
value   meaning
======= ==========================================================================
false	logging is disabled - except errors but you still need to specify log file
string	file path or stream (i.e. ``"php://stdout"``, ``"logs/application.log"``)
======= ==========================================================================

You can define the constant in your source code:

.. code-block:: php

    define('DREAMCOMMERCE_LOG_FILE', "php://stdout");

Messages can be passed to simple logger class using multiple priorities:

.. code-block:: php

    \DreamCommerce\ShopAppstoreLib\Logger::debug("debug message");
    \DreamCommerce\ShopAppstoreLib\Logger::info("informational message");
    \DreamCommerce\ShopAppstoreLib\Logger::notice("notice message");
    \DreamCommerce\ShopAppstoreLib\Logger::warning("warning message");
    \DreamCommerce\ShopAppstoreLib\Logger::error("error message");
    \DreamCommerce\ShopAppstoreLib\Logger::critical("critical message");
    \DreamCommerce\ShopAppstoreLib\Logger::alert("alert message");
    \DreamCommerce\ShopAppstoreLib\Logger::emergency("emergency message");

Debug messages are filtered if debug mode is disabled.

Own logger
**********

If you prefer to take over all logging, simply create your own class implementing
`PSR-3 Logger Interface <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md>`_
and pass it to the library.

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        array(
            'entrypoint'=>$shop->getShopUrl(),
            'client_id'=>$this->getAppId(),
            'client_secret'=>$this->getAppSecret()
        )
    );

    $client->setAccessToken($tokens->getAccessToken());

    $logger = new MyLogger();
    $client->setLogger($logger);

.. note:: If you use your own logger, all constants described above are ignored.


Catching exceptions
*******************

A code example using exceptions handling:

.. code-block:: php

    try{
        $client = Client::factory(
            Client::ADAPTER_OAUTH,
            array(
                'entrypoint'=>'https://example.com',
                'client_id'=>'app_id',
                'client_secret'=>'app_secret'
            )
        );

        $client->setAccessToken('TOKEN');

        // fetch collection/object
        $product = new \DreamCommerce\ShopAppstoreLib\Resource\Product($client);
        $list = $product->get();

        foreach($list as $item){
            //...
        }

    } catch (\DreamCommerce\ShopAppstoreLib\Resource\Exception\NotFoundException $ex) {
        \DreamCommerce\ShopAppstoreLib\Logger::debug('resource not found', array((string)$ex));
    } catch (\DreamCommerce\ShopAppstoreLib\Exception\ResourceException $ex) {
        // resource error
        \DreamCommerce\ShopAppstoreLib\Logger::error($ex);
    }

Using default logger library, all traffic is being logged unless you disable debug mode. More over,
if debugging is disabled, logger will catch all exceptions that are not covered by particular ones.
This means if server returns HTTP 500, this exception data will be stored. You can disable it at all by not setting
``DREAMCOMMERCE_LOG_FILE``.

If you need to take more control on data logging, implement your own logger.

Each exception lets to access an exception of lower layer, eg. HTTP response.
Simply use standard exception's method ``getPrevious`` on every exception.

.. code-block:: php

    try{

        // ...

    } catch (\DreamCommerce\ShopAppstoreLib\Exception\ClientException $ex) {
        \DreamCommerce\Logger::error(sprintf("Client error: %s", $ex->getMessage()));

        $prev = $ex->getPrevious();

        if($prev instanceof \DreamCommerce\ShopAppstoreLib\Exception\HttpException){
            \DreamCommerce\ShopAppstoreLib\Logger::error(sprintf("HTTP error: %s", $prev->getMessage()));

            if($prev->getCode() == \DreamCommerce\ShopAppstoreLib\Exception\HttpException::QUOTA_EXCEEDED){
                \DreamCommerce\ShopAppstoreLib\Logger::warning("Quota exceeded");
            }
        }

    } catch (\DreamCommerce\ShopAppstoreLib\Exception\ResourceException $ex) {
        \DreamCommerce\ShopAppstoreLib\Logger::error(sprintf("Resource error: %s", $ex->getMessage()));
    }

