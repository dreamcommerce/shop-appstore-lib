Debugging
=========

SDK raises errors using exceptions:

- :php:class:`DreamCommerce\\Exception\\ClientException` - informs about errors occurred within client library, eg. invalid token or credentials
- :php:class:`DreamCommerce\\Exception\\ResourceException` - connected with particular resources, eg. invalid parameters

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
false	logging is disabled
string	file path or stream (i.e. ``"php://stdout"``, ``"logs/application.log"``)
======= ==========================================================================

You can define the constant in your source code:

.. code-block:: php

    define('DREAMCOMMERCE_LOG_FILE', "php://stdout");

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

Debug messages are filtered if debug mode is disabled.

Own logger
**********

If you prefer to take over all logging, simply create your own class implementing
`PSR-3 Logger Interface <https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md>`_
and pass it to the library.

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        [
            'entrypoint'=>$shop->getShopUrl(),
            'client_id'=>$this->getAppId(),
            'client_secret'=>$this->getAppSecret()
        ]
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
        $client = new \DreamCommerce\Client(
            'https://myshop.example.com', 'Application ID', 'Secret'
        );

        $client->setAccessToken('SHOP TOKEN');

        // fetch collection/object
        $product = new \DreamCommerce\Resource\Product($client);
        $list = $product->get();

        foreach($list as $item){
            //...
        }

    } catch (\DreamCommerce\Exception\ClientException $ex) {
        // client error
        \DreamCommerce\Logger::error($ex);
    } catch (\DreamCommerce\Exception\ResourceException $ex) {
        // resource error
        \DreamCommerce\Logger::error($ex);
    }


Each exception lets to access an exception of lower layer, eg. HTTP response.
Simply use standard exception's method ``getPrevious`` on every exception.

.. code-block:: php

    try{

        // ...

    } catch (\DreamCommerce\Exception\ClientException $ex) {
        \DreamCommerce\Logger::error(sprintf("Client error: %s", $ex->getMessage()));

        $prev = $ex->getPrevious();

        if($prev instanceof \DreamCommerce\Exception\HttpException){
            \DreamCommerce\Logger::error(sprintf("HTTP error: %s", $prev->getMessage()));

            if($prev->getCode() == \DreamCommerce\Exception\HttpException::QUOTA_EXCEEDED){
                \DreamCommerce\Logger::warning("Quota exceeded");
            }
        }

    } catch (\DreamCommerce\Exception\ResourceException $ex) {
        \DreamCommerce\Logger::error(sprintf("Resource error: %s", $ex->getMessage()));
    }

