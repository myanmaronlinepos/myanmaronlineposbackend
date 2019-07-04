<?php

namespace App\Middlewares;
use App\Middlewares\Middleware;

class UserMiddleware extends Middleware{

    public function __invoke($request,$response,$next){

        if(!$this->auth->check()) {
            $response=$next($request,$response);
            return $response;
        }

        $response->getBody()->write("you must logout");
        return $response;
    }
}