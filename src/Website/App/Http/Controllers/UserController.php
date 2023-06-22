<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\View\View;

class UserController implements Controller {

    public function index($username): Response
    {
        $userData = [
            'username' => $username
        ];
        return (new ResponseBuilder())->setContent(View::render('user', $userData))->build();
    }

}