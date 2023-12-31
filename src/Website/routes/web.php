<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;
use CaveResistance\Echo\Website\App\Http\Controllers\PostController;
use CaveResistance\Echo\Website\App\Http\Controllers\FriendshipController;
use CaveResistance\Echo\Website\App\Http\Controllers\NotificationsController;
use CaveResistance\Echo\Website\App\Http\Controllers\SearchController;
use CaveResistance\Echo\Website\App\Http\Middlewares\AuthMiddleware;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\View\View;

Server::createRoute()->accept('GET', ['/', '/feed'])->withMiddlewares([
    AuthMiddleware::class
])->setHandler(FeedController::class)->add();

//---Search---
Server::createRoute()->accept('GET', '/search')->setHandler(SearchController::class)->add();

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

//----Posts----
Server::createRoute()->accept('GET', '/post/{id}')->setHandler(PostController::class)->add();

Server::createRoute()->accept(['GET', 'POST'], '/publish')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'publish'
])->add();

Server::createRoute()->accept('POST', '/comment/publish')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'publishComment'
])->add();

//----Notifications----
Server::createRoute()->accept('GET', '/notifications')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => NotificationsController::class,
    'method' => 'index'
])->add();

//---Test---
Server::createRoute()->accept('GET', '/test')->setHandler(function(){
    return (new ResponseBuilder())->setContent(View::render('test'))->build();
})->add();