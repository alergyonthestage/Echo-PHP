<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;
use CaveResistance\Echo\Website\App\Http\Controllers\PostController;
use CaveResistance\Echo\Website\App\Http\Controllers\FriendshipController;

Server::createRoute()->accept('GET', ['/', '/feed'])->setHandler(FeedController::class)->add();

//----Users----
Server::createRoute()->accept('GET', '/user/{username}')->setHandler(UserController::class)->add();

Server::createRoute()->accept('GET', '/user/{username}/friends')->setHandler(FriendshipController::class)->add();

Server::createRoute()->accept(['GET', 'POST'], '/signup')->setHandler([
    'controller' => UserController::class,
    'method' => 'signup'
])->add();

Server::createRoute()->accept(['GET', 'POST'], '/login')->setHandler([
    'controller' => UserController::class,
    'method' => 'login'
])->add();

Server::createRoute()->accept('GET', '/logout')->setHandler([
    'controller' => UserController::class,
    'method' => 'logout'
])->add();


//----Posts----
Server::createRoute()->accept('GET', '/post/{id}')->setHandler(PostController::class)->add();