<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Statuses extends Resource{

    const TYPE_NEW = 1;
    const TYPE_OPENED = 2;
    const TYPE_CLOSED = 3;
    const TYPE_UNREALIZED = 4;

    public function __construct(Client $client){
        return parent::__construct($client, 'statuses');
    }
    
}