<?php

require __DIR__ . '/Config.php';

require './BillingSystem/App.php';

try {
    $controller = new \BillingSystem\App('http://example.org');
    $controller->dispatch();

} catch (Exception $ex) {
    printf('Something went wrong: %s' . PHP_EOL, $ex->getMessage());
    if ($previous = $ex->getPrevious()) {
        printf('Previous exception details: %s' . PHP_EOL, $previous->getMessage());
    }
}