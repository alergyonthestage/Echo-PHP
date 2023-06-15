<?php

namespace CaveResistance\Echo\Server\Middlewares;

use ArrayIterator;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Handler;
use Exception;

class MiddlewareRunner {

    private ArrayIterator $middlewares;
    private Handler $destination;
    private array $params;

    public function through(array $middlewares): MiddlewareRunner 
    {
        $this->middlewares = new ArrayIterator($middlewares);
        return $this;
    }

    public function setDestination(Handler $destination): MiddlewareRunner 
    {
        $this->destination = $destination;
        return $this;
    }  
    
    private function runCurrentMiddleware(Request $request): Response 
    {
        return $this->middlewares->current()->process($request, $this->nextFunctionDispatcher());
    }

    private function runDestination($request): Response 
    {
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
    
    public function run(Request $request, array $params): Response 
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