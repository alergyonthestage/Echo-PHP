<?php

namespace CaveResistance\Echo\Server\Routing\Handlers;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Routing\Handler;
use Exception;

abstract class AbstractHandler implements Handler {

    protected function prepareParameters(Request $request, array $routeParamValues): array
    {
        $handlerParameters = [];
        foreach($this->getHandlerParameters() as $parameter) {
            if($parameter->name === 'request' && $parameter->getType()->getName() === Request::class) {
                array_push($handlerParameters, $request);
            } else if(key_exists($parameter->name, $routeParamValues)) {
                array_push($handlerParameters, $routeParamValues[$parameter->name]);
            } else {
                throw new Exception("The parameter '$parameter->name' is required, but not defined in the path requirement.");
            }
        }
        return $handlerParameters;
    }

    /**
     * Must return an array of the ReflectionParameters required by the handler.
     */
    protected abstract function getHandlerParameters(): array;
    
}