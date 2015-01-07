<?php
namespace DreamCommerce;

class Logger {

    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    /**
     * debug facility
     * @param string $message debug message
     * @param string|null $lvl level
     */
    static public function log($message, $lvl = self::DEBUG)
    {
        if(defined("DREAMCOMMERCE_DEBUG")) {
            $status = DREAMCOMMERCE_DEBUG;
        }else{
            $status = false;
        }

        if($lvl == self::DEBUG){
            if(!$status){
                // debug mode disabled
                return;
            }
        }

        $str = date('Y-m-d H:i:s') . ' ['.$lvl.']: ' . $message . PHP_EOL;
        if(defined("DREAMCOMMERCE_LOG_FILE")) {
            if(DREAMCOMMERCE_LOG_FILE) {
                file_put_contents(DREAMCOMMERCE_LOG_FILE, $str, FILE_APPEND);
            }
        }
    }

    static public function __callStatic($name, $args){
        if(isset($args[0])) {
            self::log($args[0], $name);
        }
    }
}