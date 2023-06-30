<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;

class Feed {
    
    private $posts = [];

    private function __construct($posts) {
        $this->posts = $posts;
    }

    public static function firstLoad(int $id_user) {
        return new static(static::fetch($id_user, 0, 10));
    }

    public static function loadMorePosts(int $id_user, int $from, int $to) {
        return new static(static::fetch($id_user, $from, $to));
    }

    private static function fetch(int $id_user, int $from, int $to) {
        $connection = Database::connect();

       return NULL;
    }

}

