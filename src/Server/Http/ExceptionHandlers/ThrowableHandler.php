<?php

namespace CaveResistance\Echo\Server\Http\ExceptionHandlers;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\View\View;
use Throwable;

class ThrowableHandler {

    public function response(Throwable $t): Response
    {
        if(Configurations::isSet('view.exception')) {
            $data = [
                "message" => $t->getMessage(),
                'trace' => $t->getTraceAsString()
            ];
            $content = View::render(Configurations::get('view.exception'), $data);
        } else {
            $content =<<<HTML
                <h2>Exception on echo servers</h2>
                <strong>{$t->getMessage()}</strong>
                <p>{$t->getTraceAsString()}</p>
            HTML;
        }
        return (new ResponseBuilder())->setStatusCode(500)->setContent($content)->build();
    }
}