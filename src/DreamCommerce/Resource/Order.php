<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Order extends Resource{

    const ORIGIN_SHOP = 0;
    const ORIGIN_FACEBOOK = 1;
    const ORIGIN_MOBILE = 2;
    const ORIGIN_ALLEGRO = 3;
    const ORIGIN_WEBAPI = 4;

    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_CHECKBOX = 2;
    const FIELD_TYPE_SELECT = 3;

    const FIELD_SHOW_ORDER = 8;
    const FIELD_SHOW_REGISTERED = 16;
    const FIELD_SHOW_GUEST = 32;
    const FIELD_SHOW_SIGNED_IN = 64;

    protected $name = 'orders';

}