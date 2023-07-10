<?php

namespace CaveResistance\Echo\Website\App\Model;

use JsonSerializable;

class Report implements JsonSerializable {

    public function __construct(
        private bool $success,
        private string $message
    ){}

    public function success(): bool 
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'success' => $this->success(),
            'message' => $this->getMessage()
        ];
    }
}