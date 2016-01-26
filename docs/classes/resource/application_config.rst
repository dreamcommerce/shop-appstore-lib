ApplicationConfig
=================

Check: :doc:`../resource`.

constants
*********

``CONFIG_BLOG_COMMENTS_ENABLE``
    Enable blog comments
``CONFIG_BLOG_COMMENTS_FOR_USERS``
    Only registered users are allowed to post blog comments
``CONFIG_BLOG_COMMENTS_MODERATION``
    Is blog comments moderation enabled - boolean
``CONFIG_BLOG_DOWNLOAD_FOR_USERS``
    Allow to download blog attached files - boolean
``CONFIG_BLOG_ITEMS_PER_PAGE``
    Blog items per page count
``CONFIG_COMMENT_ENABLE``
    Enable product comments - boolean
``CONFIG_COMMENT_FOR_USERS``
    Only registered users are allowed to post comments - boolean
``CONFIG_COMMENT_MODERATION``
    Is comments moderation enabled - boolean
``CONFIG_DEFAULT_CURRENCY_ID``
    Default currency identifier - integer
``CONFIG_DEFAULT_CURRENCY_NAME``
    Default currency name - ISO 4217 ("PLN") - string
``CONFIG_DEFAULT_LANGUAGE_ID``
    Default shop language identifier - integer
``CONFIG_DEFAULT_LANGUAGE_NAME``
    Default shop language name - language_REGION format (eg. "pl_PL") - string
``CONFIG_DIGITAL_PRODUCT_LINK_EXPIRATION_TIME``
    Product link expiration time (days) - integer
``CONFIG_DIGITAL_PRODUCT_NUMBER_OF_DOWNLOADS``
    Maximum downloads number per user - integer
``CONFIG_DIGITAL_PRODUCT_UNLOCKING_STATUS_ID``
    Status identifier which sends email with files - integer
``CONFIG_LOCALE_DEFAULT_WEIGHT``
    Shop weight unit:

    - KILOGRAM
    - GRAM
    - LBS
``CONFIG_LOYALTY_ENABLE``
    Is loyalty program enabled - boolean
``CONFIG_PRODUCT_DEFAULTS_ACTIVE``
    Is product active in default - boolean
``CONFIG_PRODUCT_DEFAULTS_AVAILABILITY_ID``
    Default availability identifier - integer
``CONFIG_PRODUCT_DEFAULTS_CODE``
    Default product code generating method, available values:

    - 1 - no method
    - 2 - following ID
    - 3 - random
``CONFIG_PRODUCT_DEFAULTS_DELIVERY_ID``
    Default product delivery identifier - integer
``CONFIG_PRODUCT_DEFAULTS_ORDER``
    Default ordering factor value - integer
``CONFIG_PRODUCT_DEFAULTS_STOCK``
    Default stock value - integer
``CONFIG_PRODUCT_DEFAULTS_TAX_ID``
    Default tax value identifier - integer
``CONFIG_PRODUCT_DEFAULTS_UNIT_ID``
    Default measurement unit identifier - integer
``CONFIG_PRODUCT_DEFAULTS_WARN_LEVEL``
    Default stock value warning level - integer
``CONFIG_PRODUCT_DEFAULTS_WEIGHT``
    Default product weight - float
``CONFIG_PRODUCT_NOTIFIES_ENABLE``
    Notify on product availabilities - boolean
``CONFIG_PRODUCT_SEARCH_ALL_TOKENS``
    Only for product name search - require exact phrase
``CONFIG_PRODUCT_SEARCH_CODE``
    Only for product details search - include product code
``CONFIG_PRODUCT_SEARCH_DESCRIPTION``
    Only for product details search - include product description - boolean
``CONFIG_PRODUCT_SEARCH_SHORT_DESCRIPTION``
    Only for product details search - include product short description
``CONFIG_PRODUCT_SEARCH_TYPE``
    Product search mode:

    - 1 - only in product name
    - 2 - in product name and other details
``CONFIG_REGISTRATION_CONFIRM``
    Require registration confirmation - boolean
``CONFIG_REGISTRATION_ENABLE``
    Enable user registration - boolean
``CONFIG_REGISTRATION_LOGIN_TO_SEE_PRICE``
    Only signed in users see price - boolean
``CONFIG_REGISTRATION_REQUIRE_ADDRESS``
    New users address requirements:

    - 0 - only email address and password
    - 1 - full address details
``CONFIG_SHIPPING_ADD_PAYMENT_COST_TO_FREE_SHIPPING``
    Force payment price addition even if free shipping is present - boolean
``CONFIG_SHIPPING_VOLUMETRIC_WEIGHT_ENABLE``
    Enable volumetric weight - boolean
``CONFIG_SHOPPING_ALLOW_OVERSELLING``
    Allow to sell more products than stock value - boolean
``CONFIG_SHOPPING_ALLOW_PRODUCT_DIFFERENT_CURRENCY``
    Allow to set currency per product - boolean
``CONFIG_SHOPPING_ALLOW_TO_BU_NOT_REG``
    Allow buying without registration - boolean
``CONFIG_SHOPPING_BASKET_ADDING``
    Actions performed upon product adding, available values:

    - 1 - refresh page and do not redirect to the basket
    - 2 - refresh page and perform redirection to the basket
    - 3 - do not refresh page, show confirmation message
``CONFIG_SHOPPING_BESTSELLER_ALGORITHM``
    Bestseller calculation algorithm:

    - 1 - most orders count
    - 2 - most orders amount
``CONFIG_SHOPPING_BESTSELLER_DAYS``
    Only for automatic mode - days count when product is marked as bestseller, available values:

    - 7 - last 7 days
    - 30 - last 30 days
    - 90 - last 90 days
    - 0 - lifetime
``CONFIG_SHOPPING_BESTSELLER_MODE``
    Marking as "bestseller" mode:

    - 0 - manual
    - 1 - automatic, based on users orders
``CONFIG_SHOPPING_CONFIRM_ORDER``
    Require order confirmation - boolean
``CONFIG_SHOPPING_MIN_ORDER_VALUE``
    Minimal order value - float
``CONFIG_SHOPPING_MIN_PROD_QUANTITY``
    Minimal product quantity - float
``CONFIG_SHOPPING_NEWPRODUCTS_DAYS``
    Automatic mode - number of days after product creation it will be marked as "new" - integer
``CONFIG_SHOPPING_NEWPRODUCTS_MODE``
    Products marking as "new" mode, available values:

    - 0 - manual
    - 1 - automatic, based on product creation date
``CONFIG_SHOPPING_OFF``
    Disable shopping - boolean
``CONFIG_SHOPPING_ORDER_VIA_TOKEN``
    Share order via link - boolean
``CONFIG_SHOPPING_PARCEL_CREATE_STATUS_ID``
    Order status after parcel is created - integer|null
``CONFIG_SHOPPING_PARCEL_SEND_STATUS_ID``
    Order status after parcel is sent - integer|null
``CONFIG_SHOPPING_PRICE_COMPARISON_FIELD``
    Field which products are identified by - for price comparison websites, available values:

    - code - product code
    - additional_isbn - ISBN code
    - additional_kgo - KGO price
    - additional_bloz7 - BLOZ7 code
    - additional_bloz12 - BLOZ12 code
``CONFIG_SHOPPING_PRICE_LEVELS``
    Defined price levels (1-3) - integer
``CONFIG_SHOPPING_PRODUCTS_ALLOW_ZERO``
    Allow to buy zero-priced products - boolean
``CONFIG_SHOPPING_SAVE_BASKET``
    Save basket contents - boolean
``CONFIG_SHOPPING_SHIPPING_EXTRA_STEP``
    Show shipping and payment, available values:

    - 0 - show in basket
    - 1 - show as separated step
``CONFIG_SHOPPING_UPDATE_STOCK_ON_BUY``
    Update stock values on buy - boolean
``CONFIG_SHOP_ADDRESS_1``
    Shop address line 1 - string
``CONFIG_SHOP_ADDRESS_2``
    Shop address line 2 - string
``CONFIG_SHOP_CITY``
    Shop city - string
``CONFIG_SHOP_COMPANY_NAME``
    Company name - string
``CONFIG_SHOP_COUNTRY``
    Shop country code - string
``CONFIG_SHOP_EMAIL``
    Shop mail e-mail address - string
``CONFIG_SHOP_FULL_ADDRESS``
    Shop full address - string
``CONFIG_SHOP_NAME``
    Full shop name - string
``CONFIG_SHOP_OFF``
    Is shop disabled - boolean
``CONFIG_SHOP_PHONE``
    Shop phone number - string
``CONFIG_SHOP_PROVINCE``
    Shop province - string
``CONFIG_SHOP_REGON``
    Company identification number - integer
``CONFIG_SHOP_TAX_ID``
    Tax identifier - integer
``CONFIG_SHOP_TRADE``
    Shop trade - string
``CONFIG_SHOP_TRADE_CODE``
    Shop trade code, available values:

    - children
    - books_and_multimedia
    - clothes
    - computers
    - delicatessen
    - gifts_and_accessories
    - health_and_beauty
    - hobby
    - home_and_garden
    - automotive
    - consumer_electronics
    - sport_and_travel
    - other
``CONFIG_SHOP_URL``
    Shop URL - string
``CONFIG_SHOP_ZIP_CODE``
    Shop postcode - string

