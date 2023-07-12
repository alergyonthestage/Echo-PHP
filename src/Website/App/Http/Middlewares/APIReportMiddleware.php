<?php

namespace CaveResistance\Echo\Website\App\Http\Middlewares;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Interfaces\Middlewares\Middleware;
use CaveResistance\Echo\Website\App\Model\Report;
use Closure;
use Throwable;

class APIReportMiddleware implements Middleware {

    private int $statusCode = 200;

    public function process(Request $request, Closure $next): Response {
        
        if(str_starts_with($request->getPath(), '/api/')) {
            try {
                $response = $next($request);
                $this->statusCode = $response->getStatusCode();
                return $response;
            } catch (Throwable $t) {
                return (new ResponseBuilder())->setStatusCode(
                    $this->statusCode === 200 ? 500 : $this->statusCode
                )->setJsonContent(
                    json_encode(new Report(false, $t->getMessage()))
                )->build();
            }
        }
        return $next($request);
    }
    
}