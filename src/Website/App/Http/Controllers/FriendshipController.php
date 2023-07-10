<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\User;

class FriendshipController implements Controller {

    public function index($username): Response {
        $friends = User::fromUsername($username)->getFriends();
        return (new ResponseBuilder())->setContent(View::render('user.friendship', $friends))->build();
    }
   

}