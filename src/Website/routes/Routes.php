<?php

use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Http\Controllers\HomeController;

Server::createRoute()->accept('GET', ['/', '/home'])->setHandler(HomeController::class)->add();