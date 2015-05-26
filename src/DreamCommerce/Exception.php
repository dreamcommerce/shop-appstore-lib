<?php

namespace DreamCommerce;

use Psr\Log\LoggerInterface;

/**
 * exception parent
 * @package DreamCommerce
 */
class Exception extends \Exception
{
    /**
     * @var LoggerInterface
     */
    private static $logger = null;

    /**
     * @see \Exception
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        self::getLogger()->error($this);
    }

    /**
     * @param LoggerInterface $logger
     */
    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public static function getLogger()
    {
        if(self::$logger === null) {
            self::$logger = new Logger();
        }

        return self::$logger;
    }
}
