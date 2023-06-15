<?php

namespace CaveResistance\Echo\Server\Http\Messages;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request as RequestInterface;

class Request implements RequestInterface {

    private function __construct(
        private readonly array $server,
        private readonly array $post
    ) {}

    public static function capture(): static 
    {
        return new static($_SERVER, $_POST);
    }

    public function getMethod(): string 
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getPath(): string 
    {
        return $this->server['REQUEST_URI'];
    }

    public function getPostParam(string $paramName): string
    {
        return $this->post[$paramName];
    }
}