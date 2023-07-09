<?php

namespace CaveResistance\Echo\Server\Application;

use CaveResistance\Echo\Server\Interfaces\Application\App as AppInterface;
use CaveResistance\Echo\Server\Http\Kernel as KernelImpl;
use CaveResistance\Echo\Server\Interfaces\Http\Kernel;
use CaveResistance\Echo\Server\Interfaces\Routing\Router;
use CaveResistance\Echo\Server\Routing\Router as RouterImpl;

class App implements AppInterface {

    private readonly Kernel $kernel;
    private readonly Router $router;
    
    protected function __construct(private readonly array|string $configurations)
    {
        Configurations::set($this->configurations);
    }

    protected function boot(): void 
    {
        $globalMiddlewares = Configurations::get('global_middlewares') ?? [];
        $this->router = new RouterImpl();
        $this->kernel = new KernelImpl($this->router, $globalMiddlewares);
        $routes = Configurations::get('routes');
        if(is_array($routes)) {
            foreach($routes as $route) {
                $this->requireFile($route);
            }
        } else {
            $this->requireFile($routes);
        }
    }

    private function requireFile(string $file) 
    {
        require($file);
    }

    protected function getRouter(): Router
    {
        return $this->router;
    }

    protected function getKernel(): Kernel
    {
        return $this->kernel;
    }
}