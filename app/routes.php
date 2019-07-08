<?php

$app->get('/api/check','AuthController:isLogged')->setName("auth.isLogged");


$app->group('/api/guest', function () use($app){
    
    $app->get('/allcity','CityController:getAllCity')->setName("getAllCity");
    $app->post('/signup','AuthController:postSignup')->setName("auth.signup");
    
    $app->post('/signin','AuthController:postSignin')->setName("auth.signin");
})->add(new \App\Middlewares\UserMiddleware($container));


$app->group('/api/user', function () use($app) {

    $app->post('/signout','AuthController:postSignOut')->setName("auth.signout");
    $app->get('/get/products','ProductController:getAllProducts')->setName("getproducts");
    $app->get('/get/product','ProductController:getOneProduct')->setName("getproduct");
    $app->get('/get/categorys','CategoryController:getAllCategory')->setName("getcategorys");
    $app->get('/get/city','CityController:getCity')->setName("getCity");

})->add(new \App\Middlewares\GuestMiddleware($container));

