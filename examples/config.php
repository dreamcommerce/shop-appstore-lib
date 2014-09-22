<?php

/**
 * @return PDO
 */
class Config
{
    const ENTRYPOINT = 'https://55.dev/webapi/rest/';
    const APPID = 'afbbdb69614792d8f0318d55bf33c51f';
    const APP_SECRET = 'haslo1';
    const APPSTORE_SECRET = 'haslo2';

    public static function dbConnect()
    {
        static $handle = null;
        if (!$handle) {
            $handle = new PDO('mysql:host=192.168.56.101;dbname=app', 'root', 'dupa.8');
        }

        return $handle;
    }
}