<?php

use CaveResistance\Echo\Server\Http\Messages\Request;
use CaveResistance\Echo\Server\Server;

/**
 * Autoload classes
 */
require __DIR__.'/../../../vendor/autoload.php';

/**
 * Capture the request!
 */
$request = Request::capture();

/**
 * Create the Server App with the specified configuration.
 */
$configuration = require(__DIR__.'/../config.php');
Server::create($configuration);

/**
 * Handle the request.
 */
Server::handleRequest($request);
