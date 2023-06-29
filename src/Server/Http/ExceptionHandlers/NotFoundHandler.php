<?php

namespace CaveResistance\Echo\Server\Http\ExceptionHandlers;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;
use CaveResistance\Echo\Server\View\View;

class NotFoundHandler {

    public function response(NotFoundException $exception): Response
    {
        if(Configurations::isSet('view.not_found')) {
            $content = View::render(Configurations::get('view.not_found'), ["path" => $exception->getPath()]);
        } else {
            $content =<<<HTML
                <h1>Not Found</h1>
                {$exception->getPath()} page not found. Please define a Route for this path.
            HTML;
        }
        return (new ResponseBuilder())->setStatusCode(404)->setContent($content)->build();
    }
}