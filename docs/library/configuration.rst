Configuration
=============

Library needs these parameters to be configured:

- Shop URL - each REST-ful API request needs to specify an entry point - a shop URL
- Application ID
- Secret

The configuration is done by specifying values in client object factory, eg:

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        array(
            'entrypoint'=>$params['shop_url'],
            'client_id'=>$app['app_id'],
            'client_secret'=>$app['app_secret']
        )
    );

