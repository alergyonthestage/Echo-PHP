<?php

namespace CaveResistance\Echo\Server;

use CaveResistance\Echo\Server\Application\App as ServerApp;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Routing\RouteConfigurator;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Server as ServerInterface;
use Exception;

class Server extends ServerApp implements ServerInterface {
    
    private static ServerApp|null $server = null;

    private function __construct() {}

    public static function create(array|string $configuration): void 
    {
        if(static::$server !== null) {
            throw new Exception('Server already created');
        }
        static::$server = new parent($configuration);
        static::getServer()->boot();
    }

    private static function getServer(): ServerApp
    {
        if(static::$server == null) {
            throw new Exception('Create server first: Server::create()');
        }
        return static::$server;
    }

    public static function createRoute(): RouteConfigurator 
    {
        return new RouteConfigurator(static::getServer()->getRouter());
    }

    public static function handleRequest(Request $request): void 
    {
        $response = static::getServer()->getKernel()->handle($request);
        $response->send();
    }

    public static function redirectTo(string $path, int $responseCode = 302): void
    {
        $rootPath = Configurations::get(ROOT_URL);
        http_response_code($responseCode);
        header('Location: '.$rootPath.$path);
    }
}