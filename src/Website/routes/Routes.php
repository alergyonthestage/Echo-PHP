<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;
use CaveResistance\Echo\Website\App\Http\Controllers\PostController;
use CaveResistance\Echo\Website\App\Http\Controllers\FriendshipController;
use CaveResistance\Echo\Website\App\Http\Middlewares\AuthMiddleware;
use CaveResistance\Echo\Website\App\Http\Controllers\SongController;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;

Server::createRoute()->accept('GET', ['/', '/feed'])->withMiddlewares([
    AuthMiddleware::class
])->setHandler(FeedController::class)->add();

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

Server::createRoute()->accept('GET', '/logout')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'logout'
])->add();

Server::createRoute()->accept(['GET', 'POST'], '/userinfo/edit')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'edit'
])->add();

Server::createRoute()->accept('POST', '/editprofile')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'editProfile'
])->add();

Server::createRoute()->accept('POST', '/addFriend')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'addFriend'
])->add();


//----Posts----
Server::createRoute()->accept('GET', '/post/{id}')->setHandler(PostController::class)->add();

Server::createRoute()->accept(['GET', 'POST'], '/publish')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'publish'
])->add();

Server::createRoute()->accept('POST', '/like')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'addLike'
])->add();

Server::createRoute()->accept('POST', '/comment/publish')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'publishComment'
])->add();

Server::createRoute()->accept('GET', '/getsong')->setHandler([
    'controller' => SongController::class,
    'method' => 'getsong'
])->add();