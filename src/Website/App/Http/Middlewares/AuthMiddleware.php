<?php

namespace CaveResistance\Echo\Website\App\Http\Middlewares;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Middlewares\Middleware;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Model\User;
use Closure;

class AuthMiddleware implements Middleware {

    public function process(Request $request, Closure $next): Response {
        if(User::isLogged()) {
           return $next($request);
        }
        return Server::redirectTo('/login');
    }

}