<?php

namespace CaveResistance\Echo\Server\Http\Messages;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\ResponseBuilder as ResponseBuilderInterface;

class ResponseBuilder implements ResponseBuilderInterface {

    private int $statusCode = 200;
    private string $content = '';

    public function setStatusCode(string $statusCode): ResponseBuilder
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setContent(string $content): ResponseBuilder
    {
        $this->content = $content;
        return $this;
    }

    public function build(): Response
    {
        return new Response($this->statusCode, $this->content);
    }
}