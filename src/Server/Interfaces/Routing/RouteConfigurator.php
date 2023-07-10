<?php

namespace CaveResistance\Echo\Server\Interfaces\Routing;

use Closure;

interface RouteConfigurator {

    public function accept(string|array $methods, string|array $paths): RouteConfigurator;

    public function setHandler(Closure|array|string $handler): RouteConfigurator;

    public function add(): void;

}