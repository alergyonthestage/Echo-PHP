<?php

namespace CaveResistance\Echo\Server\Routing;

use CaveResistance\Echo\Server\Interfaces\Routing\Handler;
use CaveResistance\Echo\Server\Interfaces\Routing\RouteConfigurator as RouteConfiguratorInterface;
use CaveResistance\Echo\Server\Interfaces\Routing\Router;
use CaveResistance\Echo\Server\Routing\Handlers\ClosureHandler;
use CaveResistance\Echo\Server\Routing\Handlers\ControllerHandler;
use CaveResistance\Echo\Server\Routing\Route;
use Closure;
use Exception;

class RouteConfigurator implements RouteConfiguratorInterface {

    private readonly array $methods;
    private readonly array $paths;
    private readonly Handler $handler;
    private readonly array $middlewares;

    public function __construct(
        private readonly Router $router
    ) {}

    public function accept(string|array $methods, string|array $paths): RouteConfigurator 
    {
        $this->methods = $this->formatRequiremant($methods);
        $this->paths = $this->formatRequiremant($paths);
        return $this;
    }

    private function formatRequiremant(array|string $requiremant): array 
    {
        return is_string($requiremant) ? array($requiremant) : $requiremant;
    }

    public function setHandler(Closure|array|string $handler): RouteConfigurator 
    {
        $this->handler = $this->formatAndValidateHandler($handler);
        return $this;
    }

    private function formatAndValidateHandler(Closure|array|string $handler): Handler 
    {
        if(is_array($handler)) {
            return new ControllerHandler($this->validateArrayHandler($handler));
        } else if(is_string($handler)) {
            return new ControllerHandler(array(
                'controller' => $handler,
                'method' => 'index'
            ));
        }
        return new ClosureHandler($handler);
    }

    private function validateArrayHandler(array $handler): array 
    {
        if(sizeof($handler) !== 2 || 
            !array_key_exists('controller', $handler) || 
            !array_key_exists('method', $handler)
        ) {
            throw new Exception('Non valid handler. The array must contain only \'controller\' and \'method\' keys.');
        }
        return $handler;
    }

    public function withMiddlewares(array $middlewares): RouteConfigurator
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function add(): void 
    {
        $this->router->route(new Route(
            $this->methods,
            $this->paths,
            $this->handler,
            $this->middlewares ?? []
        ));
    }

}