<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/config.php';

require './BillingSystem/App.php';

try {
    $controller = new \BillingSystem\App();
    $controller->dispatch();

} catch (Exception $ex) {
    printf('Something went wrong: %s' . PHP_EOL, $ex->getMessage());
    if ($previous = $ex->getPrevious()) {
        printf('Previous exception details: %s' . PHP_EOL, $previous->getMessage());
    }
}