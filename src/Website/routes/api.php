<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\API\SongController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\PostController;
use CaveResistance\Echo\Website\App\Http\Middlewares\AuthMiddleware;

Server::createRoute()->accept('GET', '/api/song')->setHandler([
    'controller' => SongController::class,
    'method' => 'getsong'
])->add();

Server::createRoute()->accept('GET', '/api/post/{id}')->setHandler([
    'controller' => PostController::class,
    'method' => 'getPostData'
])->add();

Server::createRoute()->accept('POST', '/api/addlike')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'addLike'
])->add();