<?php

namespace DreamCommerce\Hydrator;

use DreamCommerce\Exception;
use Zend\Stdlib\Hydrator\AbstractHydrator;
use DreamCommerce\Model\ShopInterface;

abstract class Shop extends AbstractHydrator
{
    /**
     * @var ShopInterface
     */
    protected $_shop;

    protected $_classMapping = array();

    /**
     * @param array $classMapping
     */
    public function __construct(ShopInterface $shop, $classMapping = array())
    {
        $this->_shop = $shop;
        $this->_classMapping = $classMapping;
    }

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {

    }

    protected function _fillObject(array $data, $object)
    {
        $reflection = new \ReflectionObject($object);

        foreach($data as $propertyName => $propertyValue) {
            // underscore
            $funcName = 'set' . ucfirst($propertyName);
            if(method_exists($object, $funcName)) {
                $object->$funcName($propertyValue);
                continue;
            }

            $property = $reflection->getProperty($propertyName);
            if($property->isPublic()) {
                $object->$propertyName = $propertyValue;
                continue;
            }

            // camelcase
            $propertyName = $this->_underscoreToCamelCase($propertyName);
            $funcName = 'set' . ucfirst($propertyName);
            if(method_exists($object, $funcName)) {
                $object->$funcName($propertyValue);
                continue;
            }

            $property = $reflection->getProperty($propertyName);
            if($property->isPublic()) {
                $object->$propertyName = $propertyValue;
            }
        }
    }

    protected function _getMappedObject($shopObjectName)
    {
        if(isset($this->_classMapping[$shopObjectName])) {
            return new $this->_classMapping[$shopObjectName]($this->_shop);
        }

        $className = '\\DreamCommerce\\Model\\Shop\\' . ucfirst($shopObjectName);
        if(!class_exists($className)) {
            throw new Exception('Class "' . $className . '" does not exists');
        }

        return new $className;
    }

    private function _camelCaseToUnderscore($name)
    {

    }

    private function _underscoreToCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
}