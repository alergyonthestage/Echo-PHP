<?php

namespace CaveResistance\Echo\Server\Http\Messages;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\ResponseBuilder as ResponseBuilderInterface;
use Exception;

class ResponseBuilder implements ResponseBuilderInterface {

    private int $statusCode = 200;
    private string $content = '';
    private array $headers = [];

    public function setStatusCode(int $statusCode): ResponseBuilder
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setJsonContent(string $content): ResponseBuilder
    {
        if(!empty($this->content)) {
            throw new Exception('Content already setted');
        }
        $this->content = $content;
        return $this->setHeader('Content-type', 'application/json');
    }

    public function setContent(string $content): ResponseBuilder
    {
        if(!empty($this->content)) {
            throw new Exception('Content already setted');
        }
        $this->content = $content;
        return $this;
    }

    public function setHeader(string $name, string $value): ResponseBuilder
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setMimeType(string $mimeType): ResponseBuilder
    {
        return $this->setHeader('Content-type', $mimeType);
    }

    public function build(): Response
    {
        return new Response($this->statusCode, $this->content, $this->headers);
    }
}