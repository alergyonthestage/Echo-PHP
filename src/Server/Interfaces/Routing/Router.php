<?php

namespace CaveResistance\Echo\Server\Interfaces\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;

interface Router {

    public function route(Route $route): void;

    public function dispatch(Request $request): Response;

}