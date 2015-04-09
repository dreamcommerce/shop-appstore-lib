<?php

namespace DreamCommerce;


class ResourceList extends \ArrayObject{

    public $count = 0;
    public $page;
    public $pages = 0;

    public function setCount($count){
        $this->count = $count;
    }

    public function getCount(){
        return $this->count;
    }

    public function setPage($page){
        $this->page = $page;
    }

    public function getPage(){
        return $this->page;
    }

    public function setPageCount($count){
        $this->pages = $count;
    }

    public function getPageCount(){
        return $this->pages;
    }

    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        $array = self::transform($array);

        parent::__construct($array, $flags);
    }

    public static function transform($node){
        if(!$node instanceof \ArrayObject){
            if(is_array($node) or $node instanceof \stdClass){
                foreach($node as $k => $value){
                    $node[$k] = self::transform($value);
                }
                $node = new \ArrayObject($node, \ArrayObject::ARRAY_AS_PROPS);
            }
        }
        return $node;
    }
}
