<?php

namespace CaveResistance\Echo\Server\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Routing\Route;
use CaveResistance\Echo\Server\Interfaces\Routing\RouteTable as RouteTableInterface;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;

class RouteTable implements RouteTableInterface {

    private array $routes = [];

    public function insert(Route $route): void
    {
        array_push($this->routes, $route);
    }

    public function resolve(Request $request): Route
    {
        foreach($this->routes as $route) {
            if($route->match($request)) {
                return $route;
            }
        }
        throw new NotFoundException($request->getPath());
    }
}