<?php

$app->get('/api/check','AuthController:isLogged')->setName("auth.isLogged");


$app->group('/api/guest', function () use($app){
    
    $app->get('/allcity','CityController:getAllCity')->setName("getAllCity");
    $app->post('/signup','AuthController:postSignup')->setName("auth.signup");
    
    $app->post('/signin','AuthController:postSignin')->setName("auth.signin");
})->add(new \App\Middlewares\UserMiddleware($container));


$app->group('/api/user', function () use($app) {
    
    $app->group('/get', function () use($app){
        $app->get('/userData','AuthController:getUserData')->setName("getUserData");
        $app->get('/products','ProductController:getAllProducts')->setName("getProducts");
        $app->get('/product','ProductController:getOneProduct')->setName("getProduct");
        $app->get('/categories','CategoryController:getAllCategory')->setName("getCategorys");
        $app->get('/tags','TagController:getAllTag')->setName("getTags");
        $app->get('/city','CityController:getCity')->setName("getCity");
        $app->get('/sellProduct','SellController:getAllSell')->setName("getSellProduct");
        $app->get('/inventory','InventoryController:getAllProductInventory')->setName("getInventory");
        $app->get('/product/image','ImageController:downloadProductImage')->setName("downloadProductImage");
    });
    
    $app->group('/post', function () use($app) {
        $app->post('/products','ProductController:postProducts')->setName("postProducts");
        $app->post('/product','ProductController:addProduct')->setName("addProduct");
        $app->post('/product/image','ImageController:uploadProductImage')->setName("uploadProductImage");
        $app->post('/category','CategoryController:addCategory')->setName("postCategory");
        $app->post('/tag','TagController:addTag')->setName("postTag");
        $app->post('/sell/store','SellController:storeSellHistory')->setName("storeSellItem");
        $app->post('/update_tag','TagController:updateTagName')->setName("updateTag");
        $app->post('/update_category','CategoryController:updateCategory')->setName("updateCategory");
        $app->post('/update_inventory','InventoryController:updateInventory')->setName("updateInventory");

        $app->post('/delete_category','CategoryController:deleteCategory')->setName("deleteCategory");
        $app->post('/delete_tag','TagController:deleteTag')->setName("deleteTag");

        $app->post('/update_user_data','AuthController:updateUserData')->setName("updateUserData");

        

        
    });

    $app->post('/signout','AuthController:postSignOut')->setName("auth.signout");

})->add(new \App\Middlewares\GuestMiddleware($container));

