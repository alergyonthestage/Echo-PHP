<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;
<<<<<<< Updated upstream

Server::createRoute()->accept('GET', ['/', '/home'])->setHandler(HomeController::class)->add();
=======
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;
use CaveResistance\Echo\Website\App\Http\Controllers\FeedController;

Server::createRoute()->accept('GET', '/home')->setHandler(HomeController::class)->add();

Server::createRoute()->accept('GET', '/user/{username}')->setHandler(UserController::class)->add();

Server::createRoute()->accept('GET', ['/', '/feed'])->setHandler(FeedController::class)->add();
>>>>>>> Stashed changes
