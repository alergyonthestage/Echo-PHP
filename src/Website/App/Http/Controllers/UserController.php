<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;

class UserController implements Controller {

    public function index($username): Response
    {
        return (new ResponseBuilder())->setContent("Hi $username")->build();
    }

}