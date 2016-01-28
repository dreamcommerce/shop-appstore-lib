ResourceList
============
.. php:namespace:: DreamCommerce
.. php:class:: ResourceList

Represents collection of resources, extends ArrayObject

methods
*******

.. php:method:: __construct($array = array(), $flags = \ArrayObject::ARRAY_AS_PROPS)

    Creates a new class instance.

    :param array $array: Objects in the collection
    :param integer $flags: flags for ArrayObject
    :rtype: void

.. php:method:: setCount($count)

    set number of all resources on requested list.

    :param integer $count: number of all resources on the list
    :rtype: void

.. php:method:: getCount()

    get number of all resources on requested list.

    :rtype: integer
    :returns: number of objects

.. php:method:: setPage($page)

    set current page number.

    :param integer $page: current page number
    :rtype: void

.. php:method:: getPage()

    get current page number.

    :returns: page number
    :rtype: integer

.. php:method:: setPageCount($count)

    set total page count.

    :param integer $count: total page count
    :rtype: void

.. php:method:: getPageCount()

    get total page count.

    :rtype: integer
    :returns: pages count

