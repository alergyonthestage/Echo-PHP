<?php

namespace CaveResistance\Echo\Server\Http\ExceptionHandlers;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Routing\Exceptions\NotFoundException;
use CaveResistance\Echo\Server\View\View;

class ExceptionHandler {

    public function response(NotFoundException $exception): Response
    {
        if(Configurations::isSet('view.exception')) {
            $content = View::render(Configurations::get('view.exeption'), ["message" => $exception->getMessage()]);
        } else {
            $content =<<<HTML
                <h2>Exception on echo servers</h2>
                {$exception->getMessage()}
            HTML;
        }
        return (new ResponseBuilder())->setStatusCode(500)->setContent($content)->build();
    }
}