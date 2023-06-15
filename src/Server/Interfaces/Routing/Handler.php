<?php

namespace CaveResistance\Echo\Server\Interfaces\Routing;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;

interface Handler {

    public function run(Request $request, array $pathParameters): Response;

    public function isClosure(): bool;

    public function isController(): bool;

}