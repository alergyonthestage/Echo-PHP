<?php

namespace CaveResistance\Echo\Server\Http\ExceptionHandlers;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;

class NotFoundHandler {

    public function response(NotFoundException $exception): Response
    {
        $content =<<<HTML
                <h1>Not Found</h1>
                {$exception->getPath()} page not found on CaveResistance;
            HTML;
            return (new ResponseBuilder())->setStatusCode(404)->setContent($content)->build();
    }
}