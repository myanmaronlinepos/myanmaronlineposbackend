<?php

session_start();
//testing
require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db'                  => [
            'driver'     => 'mysql',
            'host'       => 'localhost',
            'database'   => 'myanmaronlinepos',
            'username'   => 'chit',
            'password'   => 'chitnanko',
            'charset'    => 'utf8',
            'collection' => 'utf8_unicode_ci',
            'prefix'     => '',
        ],
    ],
]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// $pro
$container['product_image_directory'] = __DIR__ . '/productImages';

$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

$container['product']=function ($container) {

    return new \App\Products\ProductTableHandler;
};

$container['category']=function ($container) {

    return new \App\Categorys\CategoryTableHandler;
};

$container['city']=function ($container) {

    return new \App\City\CityTableHandler;
};

$container['inventory']=function ($container) {

    return new \App\Inventory\InventoryTableHandler;
};

$container['tag']=function ($container) {

    return new \App\Tag\TagTableHandler;
};

$container['validator'] = function ($container) {
    return new \App\Validation\Validator;
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

$container['ProductController'] = function ($container) {
    return new \App\Controllers\Products\ProductController($container);
};

$container['CategoryController'] = function ($container) {
    return new \App\Controllers\Categorys\CategoryController($container);
};

$container['CityController'] = function ($container) {
    return new \App\Controllers\Citys\CityController($container);
};

$container['InventoryController'] = function ($container) {
    return new \App\Controllers\Inventory\InventoryController($container);
};

$container['TagController'] = function ($container) {
    return new \App\Controllers\Tag\TagController($container);
};

$container['ImageController'] = function ($container) {
    return new \App\Controllers\Products\ImageController($container);
};

require __DIR__ . '/../app/routes.php';
