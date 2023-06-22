<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;
use CaveResistance\Echo\Website\App\Http\Controllers\UserController;

Server::createRoute()->accept('GET', ['/', '/home'])->setHandler(HomeController::class)->add();

Server::createRoute()->accept('GET', '/user/{username}')->setHandler(UserController::class)->add();