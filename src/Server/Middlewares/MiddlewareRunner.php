<?php

namespace CaveResistance\Echo\Server\Middlewares;

use ArrayIterator;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Handler;
use CaveResistance\Echo\Server\Interfaces\Routing\Route;
use CaveResistance\Echo\Server\Interfaces\Routing\Router;
use Exception;

class MiddlewareRunner {

    private ArrayIterator $middlewares;
    private Handler|Router $destination;
    private array $params;
    private Route|null $route;

    public function __construct(Route|null $route = null)
    {
        $this->route = $route;
    }

    private function isGlobal(): bool
    {
        return !isset($this->route);
    }

    public function through(array $middlewares): MiddlewareRunner 
    {
        $this->middlewares = new ArrayIterator($middlewares);
        return $this;
    }

    public function setDestination(Handler|Router $destination): MiddlewareRunner 
    {
        if($this->isGlobal() && $destination instanceof Handler) {
            throw new Exception('The destination of a global MiddlewareRunner must be of type Router');
        } else if(!$this->isGlobal() && $destination instanceof Router) {
            throw new Exception('The destination of a route MiddlewareRunner must be of type Handler');
        }
        $this->destination = $destination;
        return $this;
    }
    
    private function runCurrentMiddleware(Request $request): Response 
    {
        return (new ($this->middlewares->current()))->process($request, $this->nextFunctionDispatcher());
    }

    private function runDestination($request): Response 
    {
        if($this->isGlobal()) {
            return $this->destination->dispatch($request);
        }
        return $this->destination->run($request, $this->params);
    }

    private function nextFunctionDispatcher(): callable 
    {
        return function($request) {
            $this->middlewares->next();
            if($this->middlewares->valid()) {
                return $this->runCurrentMiddleware($request);
            } else {
                return $this->runDestination($request);
            } 
        };
    }
    
    public function run(Request $request, array $params = []): Response 
    {
        $this->params = $params;
        if($this->middlewares->key() != 0) {
            throw new Exception('MiddlewareRunner already executed!');
        }
        if($this->middlewares->valid()) {
            return $this->runCurrentMiddleware($request);
        } else {
            return $this->runDestination($request);
        }
    }
}