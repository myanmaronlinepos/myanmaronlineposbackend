<?php

$app->post('/auth/signup','AuthController:postSignup')->setName("auth.signup");

$app->get('/auth/check','AuthController:isLogged')->setName("auth.signin");
