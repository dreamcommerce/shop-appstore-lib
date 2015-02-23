<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

class ApplicationLock extends Resource{

    protected $isSingleOnly = true;
    protected $name = 'application-lock';

}