<?php

if(isset($config) && isset($config['debug'])){
    putenv('DREAMCOMMERCE_DEBUG='.$config['debug']);
}

spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require 'src/'.$class.'.php';
});