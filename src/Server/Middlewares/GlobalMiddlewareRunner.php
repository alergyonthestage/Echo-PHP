<?php

namespace CaveResistance\Echo\Server\Middlewares;

use ArrayIterator;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Router;
use Exception;

class GlobalMiddlewareRunner {

    private ArrayIterator $middlewares;
    private Router $destination;

    public function through(array $middlewares): GlobalMiddlewareRunner 
    {
        $this->middlewares = new ArrayIterator($middlewares);
        return $this;
    }

    public function setDestination(Router $router): GlobalMiddlewareRunner 
    {
        $this->destination = $router;
        return $this;
    }  
    
    private function runCurrentMiddleware(Request $request): Response 
    {
        return (new ($this->middlewares->current()))->process($request, $this->nextFunctionDispatcher());
    }

    private function runDestination($request): Response 
    {
        return $this->destination->dispatch($request);
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
    
    public function run(Request $request): Response 
    {
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