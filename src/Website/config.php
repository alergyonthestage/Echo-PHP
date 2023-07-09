<?php

use CaveResistance\Echo\Website\App\Http\Middlewares\Global\LayoutMiddleware;

return [
    'root_url' => 'http://echo.local',
    
    'routes' => [
        'web' => __DIR__.'/routes/web.php',
        'api' => __DIR__.'/routes/api.php'
    ],
    
    'public' => __DIR__.'/public',

    'view' => [
        'views' => __DIR__.'/views',
        'layouts' => __DIR__.'/views/layouts',
        'not_found' => 'errors.notfound'
    ],

    'database' => [
        'hostname' => '88.99.13.116',
        'username' => 'dbuser1',
        'password' => 'R4n4N4n4!',
        'dbname' => 'echo'
    ],

    'paths' => [
        'cover_art' => '/public/img/cover/',
        'profile_pic' => '/public/img/profiles/',
        'artist_pic' => '/public/img/artist/'
    ],

    'global_middlewares' => [
        LayoutMiddleware::class
    ]
];