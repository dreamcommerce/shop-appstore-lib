<?php

namespace DreamCommerce;


class ResourceList extends \ArrayObject{

    public $count = 0;
    public $page;
    public $pages;

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
        $a = array();

        // make data access more elastic, regardless getters - array or properties
        $transform = function($v) use(&$transform){
            if(!$v instanceof \ArrayObject){
                if(is_array($v) or $v instanceof \stdClass){
                    foreach($v as $k => $value){
                        $v[$k] = $transform($value);
                    }
                    $v = new \ArrayObject($v, \ArrayObject::ARRAY_AS_PROPS);
                }
            }
            return $v;
        };

        foreach($array as $k => $v){
            $a[$k] = $transform($v);
        }

        parent::__construct($a, $flags);
    }
}
