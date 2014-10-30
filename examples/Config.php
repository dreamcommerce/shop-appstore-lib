<?php
require __DIR__ . '/../src/bootstrap.php';

/**
 * Configuration data class
 */
class Config
{
    /**
     * appstore application ID
     */
    const APPID = '<INSERT APPID HERE>';

    /**
     * appsecret used within communication APP->SHOP
     */
    const APP_SECRET = '<INSERT PASSWORD HERE>';

    /**
     * appsecret used within communication SHOP->APP
     */
    const APPSTORE_SECRET = '<INSERT PASSWORD HERE>';

    /**
     * instantiate db connection
     * @return PDO
     */
    public static function dbConnect()
    {
        static $handle = null;
        if (!$handle) {
            $handle = new PDO('mysql:host=127.0.0.1;dbname=app', '', '');
        }

        return $handle;
    }
}