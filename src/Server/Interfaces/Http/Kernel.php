<?php

namespace CaveResistance\Echo\Server\Interfaces\Http;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;

interface Kernel {

    public function handle(Request $request): Response;

}