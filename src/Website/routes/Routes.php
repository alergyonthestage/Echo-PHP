<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;

Server::createRoute()->accept('GET', '/home')->setHandler(HomeController::class)->add();

Server::createRoute()->accept('GET', ['/', '/feed'])->setHandler(FeedController::class)->add();

//----Users----
Server::createRoute()->accept('GET', '/user/{username}')->setHandler(UserController::class)->add();

Server::createRoute()->accept(['GET', 'POST'], '/signup')->setHandler([
    'controller' => UserController::class,
    'method' => 'signup'
])->add();

Server::createRoute()->accept(['GET', 'POST'], '/signin')->setHandler([
    'controller' => UserController::class,
    'method' => 'signin'
])->add();