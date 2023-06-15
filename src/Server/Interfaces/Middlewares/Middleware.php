<?php

namespace CaveResistance\Echo\Server\Interfaces\Middlewares;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use Closure;

interface Middleware {

    public function process(Request $request, Closure $next): Response;

}