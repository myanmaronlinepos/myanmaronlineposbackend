<?php

$app->get('/api/check','AuthController:isLogged')->setName("auth.isLogged");


$app->group('/api/guest', function () use($app){
    
    $app->get('/allcity','CityController:getAllCity')->setName("getAllCity");
    $app->post('/signup','AuthController:postSignup')->setName("auth.signup");
    
    $app->post('/signin','AuthController:postSignin')->setName("auth.signin");
})->add(new \App\Middlewares\UserMiddleware($container));


$app->group('/api/user', function () use($app) {
    $app->post('/signout','AuthController:postSignOut')->setName("auth.signout");

    $app->group('/get', function () use($app){
        $app->get('/products','ProductController:getAllProducts')->setName("getProducts");
        $app->get('/product','ProductController:getOneProduct')->setName("getProduct");
        $app->get('/categories','CategoryController:getAllCategory')->setName("getCategorys");
        $app->get('/city','CityController:getCity')->setName("getCity");
        $app->get('/sellProduct','SellController:getAllSell')->setName("getSellProduct");
        $app->get('/inventory','InventoryController:getAllProductInventory')->setName("getInventory");
    });
    $app->group('/post', function () use($app) {
        $app->post('/products','ProductController:postProducts')->setName("postProducts");
        $app->post('/product','ProductController:addProduct')->setName("addProduct");
        $app->post('/product/image','ImageController:uploadProductImage')->setName("uploadProductImage");
        $app->post('/category','CategoryController:postCategory')->setName("postCategory");
        $app->post('/sell/store','SellController:storeSellHistory')->setName("storeSellItem");
        
    });
})->add(new \App\Middlewares\GuestMiddleware($container));

