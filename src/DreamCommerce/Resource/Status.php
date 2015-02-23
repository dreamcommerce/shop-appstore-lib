<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Status extends Resource{

    const TYPE_NEW = 1;
    const TYPE_OPENED = 2;
    const TYPE_CLOSED = 3;
    const TYPE_UNREALIZED = 4;

    protected $name = 'statuses';

}