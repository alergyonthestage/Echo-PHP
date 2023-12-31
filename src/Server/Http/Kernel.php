<?php

namespace CaveResistance\Echo\Server\Http;

use CaveResistance\Echo\Server\Http\ExceptionHandlers\NotFoundHandler;
use CaveResistance\Echo\Server\Http\ExceptionHandlers\ThrowableHandler;
use CaveResistance\Echo\Server\Interfaces\Http\Kernel as KernelInterface;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Middlewares\MiddlewareRunner;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;
use CaveResistance\Echo\Server\Routing\Router;
use Throwable;

class Kernel implements KernelInterface {

    public function __construct(
        private readonly Router $router,
        private array $middlewares = []
    ) {}

    public function handle(Request $request): Response {
        try {
            return (new MiddlewareRunner())->through($this->middlewares)->setDestination($this->router)->run($request); 
        } catch (NotFoundException $exception) {
            return (new NotFoundHandler())->response($exception);
        } catch (Throwable $trhowable) {
            return (new ThrowableHandler())->response($trhowable);
        }
    }
}