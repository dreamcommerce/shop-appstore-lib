<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Payment extends Resource{
    
    public function __construct(Client $client){
        return parent::__construct($client, 'payments');
    }
    
}