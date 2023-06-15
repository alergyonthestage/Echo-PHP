<?php

namespace CaveResistance\Echo\Server\Routing\Handlers;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use Closure;
use ReflectionFunction;

class ClosureHandler extends AbstractHandler {

    public function __construct(private Closure $handler) {}

    public function run(Request $request, array $routeParams): Response 
    {
        return ($this->handler)(...$this->prepareParameters($request, $routeParams));
    }

    public function isClosure(): bool
    {
        return true;
    }

    public function isController(): bool
    {
        return false;
    }

    protected function getHandlerParameters(): array
    {
        return (new ReflectionFunction($this->handler))->getParameters();
    }

}