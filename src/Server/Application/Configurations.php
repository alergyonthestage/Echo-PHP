<?php

namespace CaveResistance\Echo\Server\Application;
use Exception;

define('DATABASE_ACCESS', 'database');

define('ROUTES_FILE', 'routes_file');

define('VIEWS_PATH', 'view.views');

define('LAYOUTS_PATH', 'view.layouts');

define('CAVER_LAYOUT', 'view.caver_layout');

define('GUEST_LAYOUT', 'view.guest_layout');

define('ROOT_URL', 'root_url');

class Configurations {

    private static array $configurations;
    private static string $currentConfiguration;

    public static function set(array|string $configurations): void 
    {
        if(isset(static::$configurations)) {
            throw new Exception('Configurations already loaded! Cannot override.');
        }
        static::$configurations = $configurations;
    }

    public static function get(string $configuration) 
    {
        static::$currentConfiguration = $configuration;
        $confPathArray = static::getPathArray($configuration);
        return static::getConfiguration($confPathArray, static::$configurations);
    }

    private static function getPathArray(string $configuration): array 
    {
        return explode('.', $configuration);
    }

    private static function getConfiguration(array $pathArray, array $array) 
    {
        $value = static::getValueOrException(array_shift($pathArray), $array);
        if(!empty($pathArray)) {
            $value = static::getConfiguration($pathArray, $value);
        }
        return $value;
    }

    private static function getValueOrException(string $key, array $array) 
    {
        if(!key_exists($key, $array)){
            throw new Exception("The key '" . static::$currentConfiguration . "' is not defined in configurations.");
        }
        return $array[$key];
    }
}