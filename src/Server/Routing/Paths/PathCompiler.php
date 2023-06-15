<?php

namespace CaveResistance\Echo\Server\Routing\Paths;

/**
 * Compiles path requirements replacing parameters with regular expressions.
 * The compiled path could be used to check the path requirement match with a request path.
 */
class PathCompiler {

    private static string $paramSubstitution = '([^\/]+)';

    /**
     * Transforms a path or an array of paths into the corresponding regex.
     * @param string|array $paths The paths to compile.
     * @return string|array The regex expressions that match the paths.
     */
    public static function compile(string|array $paths): string|array 
    {
        if(is_array($paths)) {
            $compiledPaths = array();
            foreach($paths as $path) {
                $escPath = static::escapeSlashes($path);
                $compiledPath = '/'.static::replaceParamsWithRegex($escPath).'/';
                $compiledPaths[$compiledPath] = $path;
            }
            return $compiledPaths;
        }
        return static::replaceParamsWithRegex(static::escapeSlashes($paths));
    }

    private static function escapeSlashes(string $path) 
    {
        return str_replace('/', '\/', $path);
    }

    private static function replaceParamsWithRegex(string $path): string 
    {
        $parameters = ParamResolver::getNamesFromPathRequirement($path);
        foreach($parameters as $param) {
            $path = str_replace($param, static::$paramSubstitution, $path);
        }
        return $path;
    }
}