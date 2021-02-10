<?php

require_once 'vendor/autoload.php';

$shop = new \DreamCommerce\Component\ShopAppstore\Model\FrontShop(array(
    'uri' => 'shoper.localhost',
    'username' => 'test',
    'password' => 'test',
    'language' => 'pl_PL'
));

// pobranie ustawień sklepowych

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ShopDefaultsResource();
//$result = $resource->execute($shop);
//var_dump($result->getData());

// pobranie listy kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryListResource();
//$result = $resource->execute($shop);
//var_dump($result->getData());

// pobranie szczegółów kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryInfoResource();
//$result = $resource->getCategory($shop, 13);
//var_dump($result->getData());

// pobranie dzieci kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryChildrenResource();
//$result = $resource->getChildren($shop, 13);
//var_dump($result->getData());

// pobranie globalnego drzewa kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryGlobalTreeResource();
//$result = $resource->execute($shop);
//var_dump($result->getData());

// pobranie drzewa dla wybranej kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryTreeResource();
//$result = $resource->getTree($shop, 13);
//var_dump($result->getData());

// pobranie filtrów dla wybranej kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\CategoryFiltersResource();
//$result = $resource->getFilters($shop, 13, 'PLN');
//var_dump($result->getData());

// pobranie listy produktów dla kategorii

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductListResource();
//$result = $resource->getProducts($shop, 13, 'PLN');
//var_dump($result->getData());

// pobranie listy produktów dla kategorii z sortowaniem

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductListResource();
//$result = $resource->getProducts($shop, 13, 'PLN', array('order' => \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductListResource::ORDER_PRODUCT_PRICE_ASC));
//var_dump($result->getData());

// pobranie szczegółowych informacji o produkcie

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductInfoResource();
//$result = $resource->getProduct($shop, 13, 'PLN');
//var_dump($result->getData());

// pobranie listy produktów oznaczonych jako nowe

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductNewListResource();
//$result = $resource->getProducts($shop, 'PLN');
//var_dump($result->getData());

// pobranie listy produktów dnia

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\ProductOfDayListResource();
//$result = $resource->getProducts($shop, 'PLN');
//var_dump($result->getData());

// pobranie informacji o zalogowanym użytkowniku

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\UserInfoResource();
//$result = $resource->execute($shop);
//var_dump($result->getData());

// rejestracja klienta

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\UserRegisterResource();
//try {
//    $result = $resource->execute($shop, array(
////        'email' => 'test' . time() . '@shoper.pl',
//        'mail' => 'test' . time() . '@shoper.pl',
//        'password' => '12345'
//    ));
//    var_dump($result->getData());
//} catch(\DreamCommerce\Component\ShopAppstore\Api\Exception\ValidationException $exc) {
//    var_dump($exc->getErrors());
//} catch(\DreamCommerce\Component\ShopAppstore\Api\Exception\CommunicationException $exc) {
//    var_dump($exc->getHttpResponse());
//}

// pobranie szczegółów zamówienia

//$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\OrderInfoResource();
//$result = $resource->getOrder($shop, 2);
//var_dump($result->getData());

// pobranie listy zamówień aktualnie zalogowanego użytkownika

$resource = new \DreamCommerce\Component\ShopAppstore\Api\Resource\Front\OrderListResource();
$result = $resource->execute($shop);
var_dump($result->getData());

echo PHP_EOL;