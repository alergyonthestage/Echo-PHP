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
        'hostname' => 'sql.freedb.tech',
        'username' => 'freedb_website_user',
        'password' => 'k2@r&M8%FEh%%f5',
        'dbname' => 'freedb_echodb'
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