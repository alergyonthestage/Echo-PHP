<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Feed;
use CaveResistance\Echo\Website\App\Model\User;
use Exception;

class FeedController implements Controller { 

    public function getPosts(Request $request): Response 
    {
        $quantity = 3;
        $offset = $quantity*$request->getQueryParam('page') ?? 0;
        try {
            $posts = Feed::getPosts(User::getLogged()->getUserID(), $offset, $quantity);
            return (new ResponseBuilder())->setContent(json_encode($posts))->setMimeType('application/json')->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setContent(json_encode([]))->setMimeType('application/json')->build();
        }
    }
}