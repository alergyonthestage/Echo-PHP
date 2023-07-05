<?php

namespace CaveResistance\Echo\Server\Interfaces\Http\Messages;

interface ResponseBuilder {

    public function setStatusCode(string $statusCode): ResponseBuilder;

    public function setContent(string $content): ResponseBuilder;

    public function setMimeType(string $mimeType): ResponseBuilder;

    public function build(): Response;

}