<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

use DreamCommerce\Component\ShopAppstore\Api\DataResource;

final class ApplicationConfig extends DataResource
{
    /**
     * Shop URL - string
     */
    const CONFIG_SHOP_URL = 'shop_url';

    /**
     * Full shop name - string
     */
    const CONFIG_SHOP_NAME = 'shop_name';

    /**
     * Shop mail e-mail address - string
     */
    const CONFIG_SHOP_EMAIL = 'shop_email';

    /**
     * Company name - string
     */
    const CONFIG_SHOP_COMPANY_NAME = 'shop_company_name';

    /**
     * Shop phone number - string
     */
    const CONFIG_SHOP_PHONE = 'shop_phone';

    /**
     * Tax identifier - integer
     */
    const CONFIG_SHOP_TAX_ID = 'shop_tax_id';

    /**
     * Shop address line 1 - string
     */
    const CONFIG_SHOP_ADDRESS_1 = 'shop_address_1';

    /**
     * Shop address line 2 - string
     */
    const CONFIG_SHOP_ADDRESS_2 = 'shop_address_2';

    /**
     * Shop city - string
     */
    const CONFIG_SHOP_CITY = 'shop_city';

    /**
     * Shop postcode - string
     */
    const CONFIG_SHOP_ZIP_CODE = 'shop_zip_code';

    /**
     * Shop province - string
     */
    const CONFIG_SHOP_PROVINCE = 'shop_province';

    /**
     * Shop country code - string
     */
    const CONFIG_SHOP_COUNTRY = 'shop_country';

    /**
     * Shop trade - string
     */
    const CONFIG_SHOP_TRADE = 'shop_trade';

    /**
     * Shop trade code, available values:
     *  - children
     *  - books_and_multimedia
     *  - clothes
     *  - computers
     *  - delicatessen
     *  - gifts_and_accessories
     *  - health_and_beauty
     *  - hobby
     *  - home_and_garden
     *  - automotive
     *  - consumer_electronics
     *  - sport_and_travel
     *  - other
     */
    const CONFIG_SHOP_TRADE_CODE = 'shop_trade_code';

    /**
     * Company identification number - integer
     */
    const CONFIG_SHOP_REGON = 'shop_regon';

    /**
     * Is shop disabled - boolean
     */
    const CONFIG_SHOP_OFF = 'shop_off';

    /**
     * Shop full address - string
     */
    const CONFIG_SHOP_FULL_ADDRESS = 'shop_full_address';

    /**
     * Default tax value identifier - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_TAX_ID = 'product_defaults_tax_id';

    /**
     * Default product code generating method, available values:
     *  - 1 - no method
     *  - 2 - following ID
     *  - 3 - random
     */
    const CONFIG_PRODUCT_DEFAULTS_CODE = 'product_defaults_code';

    /**
     * Default stock value - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_STOCK = 'product_defaults_stock';

    /**
     * Default stock value warning level - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_WARN_LEVEL = 'product_defaults_warn_level';

    /**
     * Default ordering factor value - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_ORDER = 'product_defaults_order';

    /**
     * Is product active in default - boolean
     */
    const CONFIG_PRODUCT_DEFAULTS_ACTIVE = 'product_defaults_active';

    /**
     * Default product weight - float
     */
    const CONFIG_PRODUCT_DEFAULTS_WEIGHT = 'product_defaults_weight';

    /**
     * Default measurement unit identifier - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_UNIT_ID = 'product_defaults_unit_id';

    /**
     * Default availability identifier - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_AVAILABILITY_ID = 'product_defaults_availability_id';

    /**
     * Default product delivery identifier - integer
     */
    const CONFIG_PRODUCT_DEFAULTS_DELIVERY_ID = 'product_defaults_delivery_id';

    /**
     * Allow to set currency per product - boolean
     */
    const CONFIG_SHOPPING_ALLOW_PRODUCT_DIFFERENT_CURRENCY = 'shopping_allow_product_different_currency';

    /**
     * Defined price levels (1-3) - integer
     */
    const CONFIG_SHOPPING_PRICE_LEVELS = 'shopping_price_levels';

    /**
     * Save basket contents - boolean
     */
    const CONFIG_SHOPPING_SAVE_BASKET = 'shopping_save_basket';

    /**
     * Update stock values on buy - boolean
     */
    const CONFIG_SHOPPING_UPDATE_STOCK_ON_BUY = 'shopping_update_stock_on_buy';

    /**
     * Actions performed upon product adding, available values:
     *  - 1 - refresh page and do not redirect to the basket
     *  - 2 - refresh page and perform redirection to the basket
     *  - 3 - do not refresh page, show confirmation message
     */
    const CONFIG_SHOPPING_BASKET_ADDING = 'shopping_basket_adding';

    /**
     * Allow buying without registration - boolean
     */
    const CONFIG_SHOPPING_ALLOW_TO_BU_NOT_REG = 'shopping_allow_to_buy_not_reg';

    /**
     * Share order via link - boolean
     */
    const CONFIG_SHOPPING_ORDER_VIA_TOKEN = 'shopping_order_via_token';

    /**
     * Require order confirmation - boolean
     */
    const CONFIG_SHOPPING_CONFIRM_ORDER = 'shopping_confirm_order';

    /**
     * Minimal product quantity - float
     */
    const CONFIG_SHOPPING_MIN_PROD_QUANTITY = 'shopping_min_prod_quantity';

    /**
     * Minimal order value - float
     */
    const CONFIG_SHOPPING_MIN_ORDER_VALUE = 'shopping_min_order_value';

    /**
     * Disable shopping - boolean
     */
    const CONFIG_SHOPPING_OFF = 'shopping_off';

    /**
     * Allow to buy zero-priced products - boolean
     */
    const CONFIG_SHOPPING_PRODUCTS_ALLOW_ZERO = 'shopping_products_allow_zero';

    /**
     * Allow to sell more products than stock value - boolean
     */
    const CONFIG_SHOPPING_ALLOW_OVERSELLING = 'shopping_allow_overselling';

    /**
     * Order status after parcel is created - integer|null
     */
    const CONFIG_SHOPPING_PARCEL_CREATE_STATUS_ID = 'shopping_parcel_create_status_id';

    /**
     * Order status after parcel is sent - integer|null
     */
    const CONFIG_SHOPPING_PARCEL_SEND_STATUS_ID = 'shopping_parcel_send_status_id';

    /**
     * Show shipping and payment, available values:
     *  - 0 - show in basket
     *  - 1 - show as separated step
     */
    const CONFIG_SHOPPING_SHIPPING_EXTRA_STEP = 'shopping_shipping_extra_step';

    /**
     * Products marking as "new" mode, available values:
     *  - 0 - manual
     *  - 1 - automatic, based on product creation date
     */
    const CONFIG_SHOPPING_NEWPRODUCTS_MODE = 'shopping_newproducts_mode';

    /**
     * Automatic mode - number of days after product creation it will be marked as "new" - integer
     */
    const CONFIG_SHOPPING_NEWPRODUCTS_DAYS = 'shopping_newproducts_days';

    /**
     * Marking as "bestseller" mode:
     *  - 0 - manual
     *  - 1- automatic, based on users orders
     */
    const CONFIG_SHOPPING_BESTSELLER_MODE = 'shopping_bestseller_mode';

    /**
     * Only for automatic mode - days count when product is marked as bestseller, available values:
     *  - 7 - last 7 days
     *  - 30 - last 30 days
     *  - 90 - last 90 days
     *  - 0 - lifetime
     */
    const CONFIG_SHOPPING_BESTSELLER_DAYS = 'shopping_bestseller_days';

    /**
     * Bestseller calculation algorithm:
     *  - 1 - most orders count
     *  - 2 - most orders amount
     */
    const CONFIG_SHOPPING_BESTSELLER_ALGORITHM = 'shopping_bestseller_algorithm';

    /**
     * Field which products are identified by - for price comparison websites, available values:
     *  - code - product code
     *  - additional_isbn - ISBN code
     *  - additional_kgo - KGO price
     *  - additional_bloz7 - BLOZ7 code
     *  - additional_bloz12 - BLOZ12 code
     */
    const CONFIG_SHOPPING_PRICE_COMPARISON_FIELD = 'shopping_price_comparison_field';

    const CONFIG_SHOPPING_PROMO_CODES_ENABLE = 'shopping_promo_codes_enable';

    /**
     * Notify on product availabilities - boolean
     */
    const CONFIG_PRODUCT_NOTIFIES_ENABLE = 'product_notifies_enable';

    /**
     * Enable user registration - boolean
     */
    const CONFIG_REGISTRATION_ENABLE = 'registration_enable';

    /**
     * Require registration confirmation - boolean
     */
    const CONFIG_REGISTRATION_CONFIRM = 'registration_confirm';

    /**
     * Only signed in users see price - boolean
     */
    const CONFIG_REGISTRATION_LOGIN_TO_SEE_PRICE = 'registration_login_to_see_price';

    /**
     * New users address requirements:
     *  - 0 - only email address and password
     *  - 1 - full address details
     */
    const CONFIG_REGISTRATION_REQUIRE_ADDRESS = 'registration_require_address';

    /**
     * Force payment price addition even if free shipping is present - boolean
     */
    const CONFIG_SHIPPING_ADD_PAYMENT_COST_TO_FREE_SHIPPING = 'shipping_add_payment_cost_to_free_shipping';

    /**
     * Enable volumetric weight - boolean
     */
    const CONFIG_SHIPPING_VOLUMETRIC_WEIGHT_ENABLE = 'shipping_volumetric_weight_enable';

    /**
     * Product search mode:
     *  - 1 - only in product name
     *  - 2 - in product name and other details
     */
    const CONFIG_PRODUCT_SEARCH_TYPE = 'product_search_type';

    /**
     * Only for product name search - require exact phrase
     */
    const CONFIG_PRODUCT_SEARCH_ALL_TOKENS = 'product_search_all_tokens';

    /**
     * Only for product details search - include product code
     */
    const CONFIG_PRODUCT_SEARCH_CODE = 'product_search_code';

    /**
     * Only for product details search - include product short description
     */
    const CONFIG_PRODUCT_SEARCH_SHORT_DESCRIPTION = 'product_search_short_description';

    /**
     * Only for product details search - include product description - boolean
     */
    const CONFIG_PRODUCT_SEARCH_DESCRIPTION = 'product_search_description';

    /**
     * Status identifier which sends email with files - integer
     */
    const CONFIG_DIGITAL_PRODUCT_UNLOCKING_STATUS_ID = 'digital_product_unlocking_status_id';

    /**
     * Product link expiration time (days) - integer
     */
    const CONFIG_DIGITAL_PRODUCT_LINK_EXPIRATION_TIME = 'digital_product_link_expiration_time';

    /**
     * Maximum downloads number per user - integer
     */
    const CONFIG_DIGITAL_PRODUCT_NUMBER_OF_DOWNLOADS = 'digital_product_number_of_downloads';

    /**
     * Enable product comments - boolean
     */
    const CONFIG_COMMENT_ENABLE = 'comment_enable';

    /**
     * Only registered users are allowed to post comments - boolean
     */
    const CONFIG_COMMENT_FOR_USERS = 'comment_for_users';

    /**
     * Is comments moderation enabled - boolean
     */
    const CONFIG_COMMENT_MODERATION = 'comment_moderation';

    /**
     * Is loyalty program enabled - boolean
     */
    const CONFIG_LOYALTY_ENABLE = 'loyalty_enable';

    /**
     * Blog items per page count
     */
    const CONFIG_BLOG_ITEMS_PER_PAGE = 'blog_items_per_page';

    /**
     * Enable blog comments
     */
    const CONFIG_BLOG_COMMENTS_ENABLE = 'blog_comments_enable';

    /**
     * Only registered users are allowed to post blog comments
     */
    const CONFIG_BLOG_COMMENTS_FOR_USERS = 'blog_comments_for_users';

    /**
     * Is blog comments moderation enabled - boolean
     */
    const CONFIG_BLOG_COMMENTS_MODERATION = 'blog_comments_moderation';

    /**
     * Allow to download blog attached files - boolean
     */
    const CONFIG_BLOG_DOWNLOAD_FOR_USERS = 'blog_download_for_users';

    /**
     * Default URL schema for blog, available values:
     *  - 1 - /:lang/(n|blog)/:newsId
     *  - 2 - /:lang/(n|blog)/:newsName/:newsId
     *  - 3 - /:lang/(n|blog)/:newsYear/:newsName/:newsId
     *  - 4 - /:lang/(n|blog)/:newsYear/:newsMonth/:newsName/:newsId
     *  - 5 - /:lang/(n|blog)/:newsYear/:newsMonth/:newsDay/:newsName/:newsId
     */
    const CONFIG_BLOG_NEWS_DEFAULT_URL_FORMAT = 'blog_news_default_url_format';

    /**
     * Default blog category URL format, available values:
     *  - 1 - /:lang/(n|blog)/category/:categoryId
     *  - 2 - /:lang/(n|blog)/category/:categoryName/:categoryId
     */
    const CONFIG_BLOG_CATEGORY_DEFAULT_URL_FORMAT = 'blog_category_default_url_format';

    /**
     * Use new blog URL namespace, available values:
     *  - 0 - /:lang/n/*
     *  - 1 - /:lang/blog/*
     */
    const CONFIG_BLOG_USE_NEW_URL_NAMESPACE = 'blog_use_new_url_namespace';

    /**
     * Shop timezone (eg. "Europe/Warsaw") - string
     */
    const CONFIG_LOCALE_TIMEZONE = 'locale_timezone';

    /**
     * Shop weight unit:
     *  - KILOGRAM
     *  - GRAM
     *  - LBS
     */
    const CONFIG_LOCALE_DEFAULT_WEIGHT = 'locale_default_weight';

    /**
     * Default shop language name - language_REGION format (eg. "pl_PL") - string
     */
    const CONFIG_DEFAULT_LANGUAGE_NAME = 'default_language_name';

    /**
     * Default shop language identifier - integer
     */
    const CONFIG_DEFAULT_LANGUAGE_ID = 'default_language_id';

    /**
     * Default currency name - ISO 4217 ("PLN") - string
     */
    const CONFIG_DEFAULT_CURRENCY_NAME = 'default_currency_name';

    /**
     * Default currency identifier - integer
     */
    const CONFIG_DEFAULT_CURRENCY_ID = 'default_currency_id';

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'application-config';
    }
}