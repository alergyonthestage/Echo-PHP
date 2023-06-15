<?php

namespace CaveResistance\Echo\Server\Routing\Handlers;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use ReflectionMethod;

class ControllerHandler extends AbstractHandler {

    public function __construct(private array $handler) {}

    public function run(Request $request, array $routeParams): Response 
    {
        extract($this->handler);
        return (new $controller)->{$method}(...$this->prepareParameters($request, $routeParams));
    }

    protected function getHandlerParameters(): array
    {
        return (new ReflectionMethod(
            $this->handler['controller'], 
            $this->handler['method']
        ))->getParameters();
    }

    public function isClosure(): bool
    {
        return false;
    }

    public function isController(): bool
    {
        return true;
    }

}