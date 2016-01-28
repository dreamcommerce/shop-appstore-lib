Typical tasks
=============

Handling billing system events
******************************

.. code-block:: php

    $handler = $this->handler = new Handler(
        'https://myshop.example.com', 'application ID', 'Secret', 'AppStore Secret'
    );

    $handler->subscribe('install', 'installHandler');   // function name
    // $handler->subscribe('install', $installHandler);   // lambda
    // $handler->subscribe('install', array($this, 'installHandler'));   // object method

    //$handler->subscribe('billing_install', array($this, 'billingInstallHandler'));
    //$handler->subscribe('billing_subscription', array($this, 'billingSubscriptionHandler'));
    //$handler->subscribe('uninstall', array($this, 'uninstallHandler'));


Passed callback will be executed as an action handler.

Getting OAuth token
*******************

Token exchange is performed with the authorization key got during the application install.

The most convenient way is to exchange this code during the install. In billing system entry point it's enough to use:

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        [
            'entrypoint'=>'https://shop.url',
            'client_id'=>'application_id',
            'client_secret'=>'application_secret',
            'auth_code'=>'auth_code'
        ]
    );

    // and get tokens
    $token = $client->authenticate(true);

    // $token is an object with access_token, refresh_token, expires_in

The best is to store gathered tokens into the database - `access_token` is required every time an application gets
access to the shop.

Refreshing the token
********************

In case the token gets expired (look at: ``expires_in``) or in case it's invalidated, it's possible to refresh it:

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        [
            'entrypoint'=>'https://shop.url',
            'client_id'=>'application_id',
            'client_secret'=>'application_secret',
            'refresh_token'=>'refresh_token'
        ]
    );

    // and get tokens
    $token = $client->refreshTokens();

    // $token is an object with access_token, refresh_token, expires_in

This object has equal information to the example above.

Performing REST-ful request
***************************

With a valid token, it's possible to perform request to the shop according to the API documentation:

.. code-block:: php

    $client = Client::factory(
        Client::ADAPTER_OAUTH,
        [
            'entrypoint'=>'http://myshop.example.com',
            'client_id'=>'application_id',
            'client_secret'=>'application_secret'
        ]
    );

    $client->setAccessToken('SHOP TOKEN');

    // getting collection/object
    $product = new \DreamCommerce\Resource\Product($client);
    $list = $product->get();

    foreach($list as $item){
        //...
    }

    // object update
    $product->put(ID, array(...));

    // create object
    $product->post(array(...));

    // delete object
    $product->delete(ID);


