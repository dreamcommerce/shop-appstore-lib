<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class ApplicationLock extends Resource{

    protected $isSingleOnly = true;
    protected $name = 'application-lock';

}