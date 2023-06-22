<?php

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;

Server::createRoute()->accept('GET', ['/', '/home'])->setHandler(HomeController::class)->add();

Server::createRoute()->accept('GET', '/user/{username}')->setHandler(function($username) {
    return (new ResponseBuilder())->setContent("Hi $username")->build();
})->add();