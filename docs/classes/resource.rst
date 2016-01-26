Resource
========
.. php:namespace:: DreamCommerce
.. php:class:: Resource

Represents particular resource.

resources
*********

.. toctree::
    :maxdepth: 2
    :hidden:

    resource/about_page
    resource/additional_field
    resource/application_lock
    resource/application_config
    resource/application_version
    resource/attribute_group
    resource/attribute
    resource/auction
    resource/auction_house
    resource/auction_order
    resource/availability
    resource/category
    resource/categories_tree
    resource/currency
    resource/dashboard_activity
    resource/dashboard_stat
    resource/delivery
    resource/gauge
    resource/geolocation_country
    resource/geolocation_region
    resource/language
    resource/metafield
    resource/metafield_value
    resource/object_mtime
    resource/option_group
    resource/option
    resource/option_value
    resource/order_product
    resource/order
    resource/parcel
    resource/payment
    resource/producer
    resource/product
    resource/product_file
    resource/product_image
    resource/product_stock
    resource/shipping
    resource/status
    resource/subscriber_group
    resource/subscriber
    resource/tax
    resource/unit
    resource/user_address
    resource/user_group
    resource/user
    resource/webhook
    resource/zone

=================================== ==================================
resource	                        description
=================================== ==================================
:doc:`resource/about_page`          About page
:doc:`resource/additional_field`    Additional field
:doc:`resource/application_lock`    Administrator panel lock
:doc:`resource/application_config`  Application config
:doc:`resource/application_version` Application config
:doc:`resource/attribute_group`	    Attributes group
:doc:`resource/attribute`           Attribute
:doc:`resource/auction`             Auction
:doc:`resource/auction_house`       Auction house
:doc:`resource/auction_order`       Auction order
:doc:`resource/availability`        Product availability
:doc:`resource/category`            Category
:doc:`resource/categories_tree`	    Category tree
:doc:`resource/currency`            Currency
:doc:`resource/dashboard_activity`  Dashboard activity
:doc:`resource/dashboard_stat`      Sales stats
:doc:`resource/delivery`            Delivery
:doc:`resource/gauge`               Gauge
:doc:`resource/geolocation_country` Geolocation country
:doc:`resource/geolocation_region`  Geolocation region
:doc:`resource/language`            Language
:doc:`resource/metafield`           Metafield
:doc:`resource/metafield_value`     Metafield Value
:doc:`resource/object_mtime`        Modification timestamp of object
:doc:`resource/option_group`        Option group
:doc:`resource/option`              Variant
:doc:`resource/option_value`        Variant value
:doc:`resource/order_product`       Product of order
:doc:`resource/order`               Order
:doc:`resource/parcel`              Parcel
:doc:`resource/payment`             Payment method
:doc:`resource/producer`            Producer
:doc:`resource/product`             Product
:doc:`resource/product_file`        Product file
:doc:`resource/product_image`       Photo of product
:doc:`resource/product_stock`       Product stock
:doc:`resource/shipping`            Shipping method
:doc:`resource/status`              Order status
:doc:`resource/subscriber_group`    Subscriber group
:doc:`resource/subscriber`          Subscriber
:doc:`resource/tax`                 Tax value
:doc:`resource/unit`                Unit of measurement
:doc:`resource/user_address`        Shipping address
:doc:`resource/user_group`          User group
:doc:`resource/user`                User
:doc:`resource/webhook`             Webhook
:doc:`resource/zone`                Zone
=================================== ==================================

static methods
**************

.. php:staticmethod:: factory($client, $name)

    instantiates new Resource object

    :param Client $client: handle to the client library instance
    :param string $name: name of resource
    :rtype: Resource

    .. code-block:: php

        \DreamCommerce\Resource::factory($client, "product");

methods
*******

.. php:method:: delete([$id = null])

    Deletes an object by ID.

    :param integer $id: object ID
    :rtype: boolean

.. php:method:: filters($filters)

    Filters records (GET only).

    Chaining method - returns a handle to an object itself.

    :param array $filters: an array of filters
    :rtype: Resource
    :returns: chain


.. php:method:: get([...])

    Performs GET request.

    :param mixed ..: arguments
        - no argument: returns collection
        - single argument - an object with specified ID
        - more arguments - resource dependent
    :rtype: ResourceList|\ArrayObject|string

.. php:method:: getName()

    Returns a plural name of resource.

    :rtype: string

.. php:method:: limit($count)

    Restrict amount of fetched records of collection (GET only).

    Chaining method - returns a handle to an object itself.

    :param integer $count: count of records to fetch
    :rtype: Resource
    :returns: chain

.. php:method:: order($expr)

    Sorts records by specified criteria (GET only).

    Chaining method - returns a handle to an object itself.

    :param string $expr: sorting expression, eg. ``field DESC``, ``field ASC`` or ``+field``, ``-field``
    :rtype: Resource
    :returns: chain

.. php:method:: page($page)

    Specifies results page number for fetching (GET only).

    Chaining method - returns a handle to an object itself.

    :param integer $page: number of page
    :rtype: Resource
    :returns: chain

.. php:method:: post([$data = array()])

    Performs a POST request.

    Chaining method - returns a handle to an object itself.

    :param array $data: request body
    :rtype: \ArrayObject|string


.. php:method:: put([$id = null, [$data = array()]])

    Performs PUT request.

    Chaining method - returns a handle to an object itself.

    :param null|integer $id: ID of modified object
    :param array $data: request body
    :rtype: \ArrayObject|string