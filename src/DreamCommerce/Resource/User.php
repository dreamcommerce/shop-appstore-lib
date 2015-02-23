<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class User extends Resource{

    const ORIGIN_SHOP = 0;
    const ORIGIN_FACEBOOK = 1;
    const ORIGIN_MOBILE = 2;
    const ORIGIN_ALLEGRO = 3;

    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_CHECKBOX = 2;
    const FIELD_TYPE_SELECT = 3;

    const FIELD_SHOW_USER = 1;
    const FIELD_SHOW_CLIENT = 2;
    const FIELD_SHOW_REGISTRATION = 4;

    protected $name = 'users';

}