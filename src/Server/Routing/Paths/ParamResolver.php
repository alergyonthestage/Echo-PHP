<?php

namespace CaveResistance\Echo\Server\Routing\Paths;

/**
 * Extracts parameter names and values from request paths and path requirements.
 */
class ParamResolver {

    private static array $paramDelimiters = ['{', '}'];

    private static string $paramSelector = '/{.*?}/';

    /**
     * Get all parameter names from the path requirement.
     * @param string $pathRequirement The path requirement to extract the parameters name form.
     * @return array All the parameter names present in the path requirement.
     */
    public static function getNamesFromPathRequirement(string $pathRequirement): array 
    {
        $parameters = [];
        $metches = [];
        preg_match_all(static::$paramSelector, $pathRequirement, $metches);
        if(!empty($metches[0])) {
            foreach($metches[0] as $param) {
                array_push($parameters, $param);
            }
        }
        return $parameters;
    }

    /**
     * Get the matched path parameters values in the request path.
     * @param string $requestPath The request path to extract the parameters values from.
     * @param string $matchedPath The matched path requirement.
     * @return array An associative array which map every parameter name to his value in the request path.
     */
    public static function getValuesFromRequestPath(string $requestPath, string $matchedPath): array 
    {
        $params = array();
        $matchedPathSegments = static::getPathSegments($matchedPath);
        $requestPathSegments = static::getPathSegments($requestPath);
        $i = 0;
        foreach($requestPathSegments as $requestPathSegment) {
            if($matchedPathSegments[$i] !== $requestPathSegment) {
                $params[static::removeParamDelimiters($matchedPathSegments[$i])] = $requestPathSegment;
            }
            $i++;
        }
        return $params;
    }

    private static function removeParamDelimiters(string $path): string 
    {  
        return str_replace(static::$paramDelimiters, '', $path);
    }

    private static function getPathSegments(string $path): array 
    {
        return explode('/', $path);
    }
}