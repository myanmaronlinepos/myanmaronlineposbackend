<?php

$app->get('/api/check','AuthController:isLogged')->setName("auth.isLogged");

$app->post('/change_password','PasswordController:postPasswordChange')->setName("changePassword");

$app->get('/allcity','CityController:getAllCity')->setName("getAllCity");


$app->group('/api/guest', function () use($app){
    
    $app->post('/signup','AuthController:postSignup')->setName("auth.signup");

    $app->post('/checkEmail','AuthController:checkEmail')->setName("checkemail");
    
    $app->post('/signin','AuthController:postSignin')->setName("auth.signin");
})->add(new \App\Middlewares\UserMiddleware($container));


$app->group('/api/user', function () use($app) {
    
    $app->group('/get', function () use($app){
        $app->get('/products','ProductController:getAllProducts')->setName("getProducts");
        $app->get('/products/{product_id}','ProductController:getOneProduct')->setName("getProduct");
        $app->get('/product/image/{product_id}','ImageController:downloadProductImage')->setName("downloadProductImage");
        
        $app->get('/userData','AuthController:getUserData')->setName("getUserData");
        $app->get('/userImage','UserImageController:downloadUserImage')->setName("getUserImage");

        $app->get('/categories','CategoryController:getAllCategory')->setName("getCategorys");

        $app->get('/tags','TagController:getAllTag')->setName("getTags");
        $app->get('/city','CityController:getCity')->setName("getCity");

        $app->get('/sellProduct','SellController:getAllSell')->setName("getSellProduct");
        $app->get('/sellitems','SellController:getAllSellItem')->setName("getSellItem");

        $app->get('/inventory','InventoryController:getAllProductInventory')->setName("getInventory");

        $app->get('/dashboard_labels','DashboardController:getLabels')->setName("labels");
        $app->get('/dashboard_data/{start_date}/{end_date}','DashboardController:getData')->setName("data");


        
    });
    
    $app->group('/post', function () use($app) {

        $app->post('/userImage','UserImageController:uploadUserImage')->setName("postUserImage");
        $app->post('/update_user_data','AuthController:updateUserData')->setName("updateUserData");

        $app->post('/products','ProductController:postProducts')->setName("postProducts");
        $app->post('/product','ProductController:addProduct')->setName("addProduct");
        $app->post('/updateProduct','ProductController:updateProduct')->setName("updateProduct");
        $app->post('/product/image','ImageController:uploadProductImage')->setName("uploadProductImage");
        
        $app->post('/category','CategoryController:addCategory')->setName("postCategory");
        $app->post('/update_category','CategoryController:updateCategory')->setName("updateCategory");
        $app->post('/assignProduct','CategoryController:assignProduct')->setName("assignProduct");

        $app->post('/tag','TagController:addTag')->setName("postTag");
        $app->post('/sell/store','SellController:storeSellHistory')->setName("storeSellItem");
        $app->post('/update_tag','TagController:updateTagName')->setName("updateTag");
        $app->post('/update_inventory','InventoryController:updateInventory')->setName("updateInventory");

        $app->post('/delete_category','CategoryController:deleteCategory')->setName("deleteCategory");
        $app->post('/delete_tag','TagController:deleteTag')->setName("deleteTag");

        
    });

    $app->post('/signout','AuthController:postSignOut')->setName("auth.signout");

})->add(new \App\Middlewares\GuestMiddleware($container));

