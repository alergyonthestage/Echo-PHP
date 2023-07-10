<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Feed;
use CaveResistance\Echo\Website\App\Model\User;

class FeedController implements Controller { 

    public function getPosts(): Response 
    {
        $posts = Feed::getPosts(User::getLogged()->getUserID(), 0, 2);
        return (new ResponseBuilder())->setContent(json_encode($posts))->setMimeType('application/json')->build();
    }
}