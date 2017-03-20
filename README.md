shop-appstore-lib
=================

See: http://developers.shoper.pl/

# Changelog

## Version 1.2.3
* \+ added ``News``, ``NewsCategory``, ``NewsComment``, ``NewsFile``, ``NewsTag`` resources

## Version 1.2.2
* \# version constraint less restrictive
* \# changed developers e-mails

## Version 1.2.1
* \# fixed handling exception when HTTP response is empty

## Version 1.2.0
* \+ added possibility to specify requests user-agent

## Version 1.1.3
* \# fixed multiple HTTP response codes handling
* \# fixed ``Aboutpage`` autoloading issue (file name case problem)

## Version 1.1.2
* \+ new constants documented
* \# fixed ``HandlerException`` and ``HttpException`` exceptions hierarchy

## Version 1.1.1
* \+ ``AuctionHouse`` and ``AuctionZone`` resources
* \+ added ability to use more than single field in ``Resource::order`` argument
* \# some phpdoc clean-up

## Version 1.1.0
* \# fixed PHP 5.3 compatibility issues
* \# forgetting to base64 encode files payload now will return more specific exception with corresponding message

## Version 1.0.2
* \# ``Handler`` client instantiation fix re-applied; last time was present only in changelog

## Version 1.0.1
* \# fixed ``Handler`` client instantiation

## Version 1.0.0
* \# refactored debugging facilities - added particular exceptions, eg. ``NotFoundException``, etc. 
* \# stripped away some rubbish code
* \# narrowed namespace of library - ``DreamCommerce\\ShopAppstoreLib``
* \# improved error logging - exceptions have attached all request/response data
* \# removed magic, especially ``__call`` on ``Resource``

## Version 0.2.16
* \+ ``GeolocationSubregion`` resource added

## Version 0.2.15
* \# another ``MetafieldValue`` collection hydration fix and docs adjustments

## Version 0.2.14
* \# fixed ``MetafieldValue`` collection hydration

## Version 0.2.13
* \# fixed ``AdditionalField`` resource typo
* \# fixed custom logger issue

## Version 0.2.12
* \# fixed GZIP issues on some servers

## Version 0.2.11
* \# ``CategoriesTree`` strict warning fixed

## Version 0.2.10
* \# fixed README
* \# fixed method signatures according to strict standards
* \+ added GZIP request headers for lower traffic

## Version 0.2.9
* \+ added ``AdditionalField``, ``ApplicationConfig`` resources
* \+ added two authentication methods
* \+ added HEAD method for records calculation
* \# fixed PHP 5.3 compatibility issues - broken data encoding

## Version 0.2.8
* \# fixed PHP 5.3 compatibility issues

## Version 0.2.7
* \+ added resources: ``Gauge``
* \+ added API error language switching
* \+ added links in phpdoc for API documentations
* \# polished code to meet PSR standards more

## Version 0.2.6
* \+ added resources: ``ApplicationVersion``, ``GeolocationCountry``, ``GeolocationRegion``, ``Zone``

## Version 0.2.5
* \# maintenance release - removed unused code from library

## Version 0.2.4
* \+ introduced new library developer
* \+ token invalid event
* \# fixed MetafieldValue data hydration

## Version 0.2.3
* \# fixed criteria reset before pagination occurs

## Version 0.2.2
* \# logger has been fixed

## Version 0.2.1
* \# ``AuctionOrder`` resource

## Version 0.2.0
* \# internal library refactoring

## Version 0.1.10
* \# API has been fixed

## Version 0.1.9
* \# fixed API resource name typo

## Version 0.1.8
* \# fixed problem with POST ID returning

## Version 0.1.7
* \# fixed response hydration for GET#ID (previously array returned instead of ArrayObject)

## Version 0.1.6
* \# fixed records sorting by complex keys, such as ``translations.pl_PL.name``

## Version 0.1.5
* \# changed ``Handler::actionExists`` and ``Handler::verifyPayload`` visibility for better portability

## Version 0.1.4
* \# fixed metafield collection

## Version 0.1.3
* \# fixed stability requirement for Composer

## Version 0.1.2

* \+ added changelog
* \# fixed Composer's license info

## Version 0.1.1

* \+ Added Aboutpages resource
* \# removed unnecessary imports
