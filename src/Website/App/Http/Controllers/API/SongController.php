<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Song;

class SongController implements Controller {

    public function search(Request $request): Response {
        $result = Song::search($request->getQueryParam('search'));
        return (new ResponseBuilder())->setJsonContent(json_encode($result))->build();
    }

}