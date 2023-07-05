<?php

namespace CaveResistance\Echo\Server\Http\Messages;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response as ResponseInterface;

class Response implements ResponseInterface {

    public function __construct(
        private int $statusCode,
        private string $content,
        private array $headers
    ) {
        http_response_code($statusCode);
    }

    public function send(): void 
    {
        foreach($this->headers as $name => $value) {
            header($name.': '.$value);
        }
        echo $this->content;
    }

}
