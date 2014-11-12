<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class Attribute extends Resource{

    const TYPE_TEXT = 0;
    const TYPE_CHECKBOX = 1;
    const TYPE_SELECT = 2;
    
    public function __construct(Client $client){
        return parent::__construct($client, 'attributes');
    }
    
}