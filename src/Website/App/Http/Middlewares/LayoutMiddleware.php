<?php

namespace CaveResistance\Echo\Website\App\Http\Middlewares;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Middlewares\Middleware;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\User;
use Closure;

class LayoutMiddleware implements Middleware {

    public function process(Request $request, Closure $next): Response {
        if(User::isLogged()) {
            View::setLayout('logged');
        }
        return $next($request);
    }

}