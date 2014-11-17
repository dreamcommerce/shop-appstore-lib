<?php
require_once __DIR__ . '/../src/bootstrap.php';

return array(
    'appId'
        => 'INSERT APP ID HERE',
    'appSecret'
        => 'INSERT APP SECRET HERE',
    'appstoreSecret'
        => 'INSERT APPSTORE SECRET HERE',
    'db' => array(
        'connection' =>
            'mysql:host=127.0.0.1;dbname=app',
        'user' =>
            'root',
        'pass' =>
            ''
    )
);