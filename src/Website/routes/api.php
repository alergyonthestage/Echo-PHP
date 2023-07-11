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
    'method' => 'getsong'
])->add();

/**---POSTS---*/

Server::createRoute()->accept('GET', '/api/post/{id}')->setHandler([
    'controller' => PostController::class,
    'method' => 'getPostData'
])->add();

Server::createRoute()->accept('GET', '/api/comment/{id}')->setHandler([
    'controller' => PostController::class,
    'method' => 'getPostData'
])->add();

Server::createRoute()->accept('POST', '/api/like')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => PostController::class,
    'method' => 'toggleLike'
])->add();

/**---USER---*/

Server::createRoute()->accept('POST', '/api/avatar')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'editAvatar'
])->add();

Server::createRoute()->accept('POST', '/api/friend/add')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'addFriend'
])->add();

// Cancel the request sent by the logged user to the user with the given id
Server::createRoute()->accept('POST', '/api/friend/cancel')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'cancelFriendRequest'
])->add();

// Remove the friend with the given id from the logged user's friend list
Server::createRoute()->accept('POST', '/api/friend/remove')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'removeFriend'
])->add();

// Decline the request sent by the user with the given id to the logged user
Server::createRoute()->accept('POST', '/api/friend/decline')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'declineFriendRequest'
])->add();

// Accept the request sent by the user with the given id to the logged user
Server::createRoute()->accept('POST', '/api/friend/accept')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => UserController::class,
    'method' => 'acceptFriendRequest'
])->add();


/**---FEED---*/

Server::createRoute()->accept('GET', '/api/feed')->withMiddlewares([
    AuthMiddleware::class
])->setHandler([
    'controller' => FeedController::class,
    'method' => 'getPosts'
])->add();