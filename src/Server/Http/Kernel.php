<?php

namespace CaveResistance\Echo\Server\Http;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\ExceptionHandlers\NotFoundHandler;
use CaveResistance\Echo\Server\Interfaces\Http\Kernel as KernelInterface;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Middlewares\GlobalMiddlewareRunner;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;
use CaveResistance\Echo\Server\Routing\Router;

class Kernel implements KernelInterface {

    protected array $middlewares = [];

    public function __construct(
        private readonly Router $router
    ) {
        if(Configurations::isSet('global_middlewares')) {
            $this->middlewares = Configurations::get('global_middlewares');
        }
    }

    public function handle(Request $request): Response {
        try {
            return (new GlobalMiddlewareRunner())->through($this->middlewares)->setDestination($this->router)->run($request); 
        } catch(NotFoundException $exception) {
            return (new NotFoundHandler())->response($exception);
        }
    }
}