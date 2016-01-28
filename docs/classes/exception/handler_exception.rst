HandlerException
================
.. php:namespace:: DreamCommerce\Exception
.. php:class:: HandlerException

An exception raised upon billing system responder error.

constants
*********

``ACTION_HANDLER_NOT_EXISTS``
    action handler doesn't exist
``ACTION_NOT_EXISTS``
    tried to handle non-existing action
``ACTION_NOT_SPECIFIED``
    an action to handle has not been specified
``CLIENT_INITIALIZATION_FAILED``
    an error occurred upon client class initialization - probably invalid data/tokens provided
``HASH_FAILED``
    packet checksum is invalid
``INCORRECT_HANDLER_SPECIFIED``
    handler for action is invalid
``PAYLOAD_EMPTY``
    server returned a response with no data

