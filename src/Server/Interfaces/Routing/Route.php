<?php

namespace CaveResistance\Echo\Server\Interfaces\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Routing\Handler;

interface Route {

    /**
     * Checks if a request match the route.
     * @param Request $request  The request to match.
     * @return bool True if the request matches the route, false otherwise.
     */
    public function match(Request $request): bool; 

    /**
     * Runs the route handler for the given request.
     * @param Request $request  The request to handle.
     * @return Response The response returned by the handler.
     */
    public function run(Request $request): Response;

    /**
     * Get an array of requiremants to match this Route.
     * @return array The requiremants to match this Route.
     */
    public function getRequirements(): array;

    /**
     * Check if the route handler is a Closure.
     * @return bool True if the handler is a Closure, False otherwise.
     */
    public function handlerIsClosure(): bool;

    /**
     * Check if the route handler is a Controller.
     * @return bool True if the handler is a Controller, False otherwise.
     */
    public function handlerIsController(): bool;

    /**
     * Get the route handler.
     * @return Handler The route handler.
     */
    public function getHandler(): Handler;
}