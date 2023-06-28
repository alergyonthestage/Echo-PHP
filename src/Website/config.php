<?php

return [
    'root_url' => 'http://echo.local',
    
    'routes_file' => __DIR__.'/routes/Routes.php',
    
    'view' => [
        'views' => __DIR__.'/views',
        'layouts' => __DIR__.'/views/layouts'
    ],

    'database' => [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => 'aledj3610',
        'dbname' => 'echo'
    ],

    'paths' => [
        'profile' => '/public/img/profiles/',
        'cover_art' => '/public/img/cover/'
    ]
];