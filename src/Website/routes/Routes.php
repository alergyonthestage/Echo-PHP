<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;

Server::createRoute()->accept('GET', '/home')->setHandler(HomeController::class)->add();

Server::createRoute()->accept('GET', '/user/{username}')->setHandler(UserController::class)->add();

Server::createRoute()->accept('GET', ['/', '/feed'])->setHandler(FeedController::class)->add();

//Register
Server::createRoute()->accept('GET', '/register')->setHandler([
    'controller' => UserController::class,
    'method' => 'register'
])->add();

Server::createRoute()->accept(['GET', 'POST'], '/singup')->setHandler([
    'controller' => UserController::class,
    'method' => 'singup'
])->add();