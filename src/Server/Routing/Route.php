<?php

namespace CaveResistance\Echo\Server\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Handler;
use CaveResistance\Echo\Server\Interfaces\Routing\Route as RouteInterface;
use CaveResistance\Echo\Server\Middlewares\MiddlewareRunner;
use CaveResistance\Echo\Server\Routing\Paths\ParamResolver;
use CaveResistance\Echo\Server\Routing\Paths\PathCompiler;

class Route implements RouteInterface {

    private readonly array $acceptedMethods;
    private readonly array $acceptedPaths;
    private Handler $handler;
    private array $middlewares;

    public function __construct(array $acceptedMethods, array $acceptedPaths, Handler $handler, array $middlewares) 
    {
        $this->acceptedMethods = $acceptedMethods;
        $this->acceptedPaths = PathCompiler::compile($acceptedPaths);
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    public function match(Request $request): bool
    {
        return $this->matchMethod($request->getMethod()) && $this->matchPath($request->getPath());
    }

    private function matchMethod(string $method): bool 
    {
        return in_array($method, $this->acceptedMethods);
    }

    private function matchPath(string $path): bool 
    {
        return is_string($this->getMatchedPath($path)) ? true : false;
    }

    /**
     * Get the Route path requiremant matched by the request path, if any.
     * @param string $requestPath The request path to match.
     * @return string|false The path requiremant matched by the request path, or false if the request path does not match this route.
     */
    private function getMatchedPath(string $requestPath): string|false
    {
        foreach($this->acceptedPaths as $compiledPath => $sourcePath) {
            $matches = [];
            preg_match($compiledPath, $requestPath, $matches);
            if(!empty($matches) && $matches[0]===$requestPath) {
                return $sourcePath;
            }
        }
        return false;
    }

    public function run(Request $request): Response
    {
        $params = ParamResolver::getValuesFromRequestPath($request->getPath(), $this->getMatchedPath($request->getPath()));
        return (new MiddlewareRunner($this))->through($this->middlewares)->setDestination($this->handler)->run($request, $params);
    }

    public function getRequirements(): array 
    {
        return array(
            'acceptedMethods' => $this->acceptedMethods,
            'acceptedPaths' => $this->acceptedPaths
        );
    }

    public function handlerIsClosure(): bool 
    {
        return $this->handler->isClosure();
    }

    public function handlerIsController(): bool
    {
        return $this->handler->isController();
    }

    public function getHandler(): Handler
    {
        return $this->handler;
    }
}