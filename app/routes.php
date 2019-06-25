<?php

$app->post('/auth/signup','AuthController:postSignin')->setName("auth.signup");