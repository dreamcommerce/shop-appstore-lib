<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Client;

class ProductImage extends Resource{
    
    public function __construct(Client $client){
        return parent::__construct($client, 'product-images');
    }
    
}