<?php

namespace CaveResistance\Echo\Server\Http;

use CaveResistance\Echo\Server\Http\ExceptionHandlers\NotFoundHandler;
use CaveResistance\Echo\Server\Interfaces\Http\Kernel as KernelInterface;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;
use CaveResistance\Echo\Server\Routing\Router;

class Kernel implements KernelInterface {

    public function __construct(
        private readonly Router $router
    ) {}

    public function handle(Request $request): Response {
        try {
            return $this->router->dispatch($request); 
        } catch(NotFoundException $exception) {
            return (new NotFoundHandler())->response($exception);
        }
    }
}