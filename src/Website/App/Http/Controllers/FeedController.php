<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Server\Application\Configurations;

class FeedController implements Controller {

    public function index(): Response
    {
        return (new ResponseBuilder())->setContent(View::render('feed'))->build();
    }
}