<?php

namespace CaveResistance\Echo\Server\Interfaces;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Routing\RouteConfigurator;

/**
 * Facade to interact with the Server Application from the Website Project files.
 */
interface Server {

    /**
     * Creates a new Server Application and load the configuration.
     * 
     * The configuration must be an array or a path to the configuration file, 
     * which returns the configuration array.
     * 
     * @param array|string $configuration  The configuration to load.
     */
    public static function create(array $configuration): void;

    /**
     * Registers a new route on the Server Application.
     */
    public static function createRoute(): RouteConfigurator;

    /**
     * Handles a new request on Server Application and send the response to the client.
     * 
     * @param Request $request  The request to handle.
     */
    public static function handleRequest(Request $request): void;

    /**
     * Redirect to the specified local path.
     */
    public static function redirectTo(string $path): void;
}