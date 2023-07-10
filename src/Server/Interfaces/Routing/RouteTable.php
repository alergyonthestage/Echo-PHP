<?php

namespace CaveResistance\Echo\Server\Interfaces\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Routing\Route;

interface RouteTable {

    public function insert(Route $route): void;

    public function resolve(Request $request): Route;

}