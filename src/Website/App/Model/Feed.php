<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;

class Feed {
    
    private $posts = [];

    private function __construct($posts) {
        $this->posts = $posts;
    }

    public static function getPosts(int $id_user, int $from, int $to) {
        return new static(static::fetch($id_user, $from, $to));
    }

    private static function fetch(int $id_user, int $from, int $to) {
        $connection = Database::connect();
    }

}

