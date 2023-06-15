<?php

namespace CaveResistance\Echo\Server\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Route;
use CaveResistance\Echo\Server\Interfaces\Routing\Router as RouterInterface;
use CaveResistance\Echo\Server\Interfaces\Routing\RouteTable;
use CaveResistance\Echo\Server\Routing\RouteTable as RouteTableImpl;

class Router implements RouterInterface {

    private RouteTable $routes;

    public function __construct()
    {
        $this->routes = new RouteTableImpl();
    }

    public function route(Route $route): void 
    {
        $this->routes->insert($route);
    }

    public function dispatch(Request $request): Response
    {
        $route = $this->routes->resolve($request);
        return $route->run($request);
    }

}