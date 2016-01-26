Configuration
=============

Library needs these parameters to be configured:

- Shop URL - each REST-ful API request needs to specify an entry point - a shop URL
- Application ID
- Secret

The configuration is done by specifying values in client object constructor:

.. code-block:: php

    $client = new \DreamCommerce\Client(
        'https://myshop.example.com', 'application ID', 'secret'
    );

