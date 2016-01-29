<?php
namespace DreamCommerce;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

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
            if(!$status){
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