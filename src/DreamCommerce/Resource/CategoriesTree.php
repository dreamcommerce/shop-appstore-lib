<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class CategoriesTree extends Resource{

    protected $isSingleOnly = true;
    
    public function __construct(Client $client){
        return parent::__construct($client, 'categories-tree');
    }
    
}