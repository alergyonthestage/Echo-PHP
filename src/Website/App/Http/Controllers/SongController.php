<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Song;

class SongController implements Controller {

    public function index(Request $request): Response {
        $result = Song::search($request->getGetParam('search'));
        return (new ResponseBuilder())->setContent(json_encode(array_map(function($song) {
            return $song->toJson();
        }, $result)))->setMimeType('application/json')->build();
    }

}