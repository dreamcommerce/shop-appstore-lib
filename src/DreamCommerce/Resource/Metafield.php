<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Metafield extends Resource{

    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;
    const TYPE_BLOB = 4;

    public function __construct(Client $client){
        return parent::__construct($client, 'metafields');
    }
    
}