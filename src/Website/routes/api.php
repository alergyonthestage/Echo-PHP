<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\API\SongController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\PostController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\UserController;
use CaveResistance\Echo\Website\App\Http\Controllers\API\FeedController;
use CaveResistance\Echo\Website\App\Http\Middlewares\AuthMiddleware;

/**---SONG---*/

Server::createRoute()->accept('GET', '/api/song')->setHandler([
    'controller' => SongController::class,
    'method' => 'search'
])->add();

/**---POSTS---*/

Server::createRoute()->accept('GET', '/api/post/{id}')->setHandler([
    'controller' => PostController::class,
    'method' => 'getPostData'
])->add();

Server::createRoute()->accept('GET', '/api/post/{id}/comments')->setHandler([
    'controller' => PostController::class,
    'method' => 'getPostComments'
])->add();

Server::createRoute()->accept('POST', '/api/like')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'toggleLike'
])->add();

/**---USER---*/

Server::createRoute()->accept('GET', '/api/user')->setHandler([
    'controller' => UserController::class,
    'method' => 'search'
])->add();

Server::createRoute()->accept('POST', '/api/avatar')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'editAvatar'
])->add();

/**---FRIENDSHIP---*/

Server::createRoute()->accept('POST', '/api/friendship/request')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'requestFriendship'
])->add();

Server::createRoute()->accept('POST', '/api/friendship/accept')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'acceptFriendship'
])->add();

Server::createRoute()->accept('POST', '/api/friendship/droprequest')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'dropFriendshipRequest'
])->add();

Server::createRoute()->accept('POST', '/api/friendship/decline')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'declineFriendshipRequest'
])->add();

Server::createRoute()->accept('POST', '/api/friendship/remove')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'removeFriendship'
])->add();

/**---FEED---*/

Server::createRoute()->accept('GET', '/api/feed')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => FeedController::class,
    'method' => 'getPosts'
])->add();