<?PHP
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

class Attribute extends Resource{

    const TYPE_TEXT = 0;
    const TYPE_CHECKBOX = 1;
    const TYPE_SELECT = 2;

    protected $name = 'attributes';

}