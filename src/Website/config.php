<?php

use CaveResistance\Echo\Website\App\Http\Middlewares\LayoutMiddleware;

return [
    'root_url' => 'http://echo.local',
    
    'routes_file' => __DIR__.'/routes/Routes.php',
    
    'view' => [
        'views' => __DIR__.'/views',
        'layouts' => __DIR__.'/views/layouts',
        'not_found' => 'errors.notfound'
    ],

    'database' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'echo'
    ],

    'paths' => [
        'cover_art' => '/public/img/cover/',
        'profile_pic' => '/public/img/profiles/',
        'artist_pic' => '/public/img/artist/',
        'default_pic' => '/public/img/default.png'
    ],

    'user' => [
        'verified_suffix' => '<i class="fas fa-check-circle" title="Profilo verificato"></i>'
    ],

    'global_middlewares' => [
        LayoutMiddleware::class
    ]
];