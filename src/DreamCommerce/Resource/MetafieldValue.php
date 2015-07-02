<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

class MetafieldValue extends Resource{

    protected $name = 'metafield-values';

    protected function isCollection($args){
        return empty($args[1]);
    }


}