<?php
namespace DreamCommerce;

/**
 * exception parent
 * @package DreamCommerce
 */
class Exception extends \Exception
{

    /**
     * @see \Exception
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        self::debug(var_export($this, true), get_class($this));
    }

    /**
     * debug facility
     * @param string $message debug message
     * @param string|null $ctx context
     */
    static public function debug($message, $ctx = null)
    {
        static $status = null;

        if ($status === null) {
            $status = getenv('DREAMCOMMERCE_DEBUG');
        }

        if ($status) {
            $str = date('[Y-m-d H:i:s]') . '['.$ctx.']' . $message . PHP_EOL;
            if (is_bool($status) && $status) {
                echo $str;
            } else if (is_string($status)) {
                file_put_contents($status, $str, FILE_APPEND);
            }
        }
    }


} 