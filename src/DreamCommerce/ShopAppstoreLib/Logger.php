<?php
namespace DreamCommerce\ShopAppstoreLib;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

class Logger extends AbstractLogger
{
    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = array())
    {
        if(defined("DREAMCOMMERCE_DEBUG")) {
            $status = DREAMCOMMERCE_DEBUG;
        }else{
            $status = false;
        }

        if($level == LogLevel::DEBUG){
            if(!in_array($level, [
                LogLevel::ERROR,
                LogLevel::CRITICAL,
                LogLevel::EMERGENCY
            ]) && !$status){
                // debug mode disabled
                return;
            }
        }

        if($context){
            $message .= sprintf(', context: %s', var_export($context, true));
        }

        $str = date('Y-m-d H:i:s') . ' ['.$level.']: ' . $message . PHP_EOL;
        if(defined("DREAMCOMMERCE_LOG_FILE")) {
            if(DREAMCOMMERCE_LOG_FILE) {
                file_put_contents(DREAMCOMMERCE_LOG_FILE, $str, FILE_APPEND);
            }
        }
    }
}