<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;

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

        //tutti i post il cui autore è amico com l'utente loggato, ordinati per data e ora
        $stmt = $connection->prepare("SELECT * FROM post WHERE id_user");
        $stmt->bind_param('i', $id_post);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new PostNotFound($id_post);
        }
        $post = $result->fetch_array();
    }

}

