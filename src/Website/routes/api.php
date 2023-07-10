<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\API\SongController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\PostController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\UserController;
use CaveResistance\Echo\Website\App\Http\Middlewares\AuthMiddleware;

/**---SONG---*/

Server::createRoute()->accept('GET', '/api/song')->setHandler([
    'controller' => SongController::class,
    'method' => 'getsong'
])->add();

/**---POSTS---*/

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

/**---USER---*/

Server::createRoute()->accept('POST', '/api/avatar')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'editAvatar'
])->add();

Server::createRoute()->accept('POST', '/addFriend')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'addFriend'
])->add();