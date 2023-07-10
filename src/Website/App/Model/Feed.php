<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Exceptions\PostNotFound;
use Exception;

class Feed {
    
    private array $posts = [];

    private function __construct($posts) {
        $this->posts = $posts;
    }

    public static function getPosts(int $id_user, int $offset, int $quantity) {
        return new static(static::fetch($id_user, $offset, $quantity));
    }

    private static function fetch(int $id_user, int $offset, int $quantity) {
        $connection = Database::connect();

        $stmt = $connection->prepare("SELECT * FROM post ORDER BY date, time; LIMIT ?,?");
        $stmt->bind_param('iii', $id_post, $offset, $quantity);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new PostNotFound($id_post);
        }
        $posts = [];
        while($post = $result->fetch_object()) {
            $posts[] = $post;
        }
        return $posts;
    }

}

