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
            'username' => $username,
            'name' => 'Alessandro Antonini',
            'profileURI' => '/public/img/profiles/vertical.jpeg',
            'echoes' => '1120',
            'posts' => '432',
            'friends' => '982',
            'biography' => 'Love Techno music 💿
            <br>From California 🇺🇸
            <br>04/21 ❤️'
        ];
        return (new ResponseBuilder())->setContent(View::render('user', $userData))->build();
    }

}