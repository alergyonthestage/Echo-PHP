<?php

namespace CaveResistance\Echo\Server\Interfaces\Http\Messages;

interface Request {

    public static function capture(): static;

    public function getMethod(): string;

    public function getPath(): string;

    public function getPostParam(string $paramName): string;

    public function getFiles(): array;

}