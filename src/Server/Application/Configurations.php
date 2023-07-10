<?php

namespace CaveResistance\Echo\Server\Application;
use Exception;

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

    public static function isSet(string $configuration): bool 
    {
        try {
            static::get($configuration);
            return true;
        } catch (Exception $e) {
            return false;
        }
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