<?php

namespace App\Middlewares;
use App\Middlewares\Middleware;

class GuestMiddleware extends Middleware{

    public function __invoke($request,$response,$next){

        if($this->auth->check()) {
            $response=$next($request,$response);
            return $response;
        }

        $response->getBody()->write("forbidden");
        return $response;
    }
}