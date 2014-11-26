<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class ApplicationLock extends Resource{

    protected $isSingleOnly = true;

    public function __construct(Client $client){
        return parent::__construct($client, 'application-lock');
    }
    
}