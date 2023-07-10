<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use Exception;
use JsonSerializable;

class Feed implements JsonSerializable {

    private function __construct(
        private array $posts = []
    )
    {}
    
    public static function getPosts(int $id_user, int $offset, int $quantity)
    {
        return new static(static::fetch($id_user, $offset, $quantity));
    }

    private static function fetch(int $id_user, int $offset, int $quantity): array
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM post WHERE id_user IN
        (SELECT friend FROM (SELECT friend2 AS friend FROM friendship WHERE friend1 = ? UNION ALL SELECT friend1 AS friend FROM friendship WHERE friend2 = ?)
        AS subquery GROUP BY friend HAVING COUNT(*) > 1) OR id_user IN (SELECT id_user FROM user WHERE id_user = ?) ORDER BY timestamp DESC LIMIT ?,?;");
        $stmt->bind_param('iiiii', $id_user, $id_user, $id_user, $offset, $quantity);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new Exception("No post to show");
        }
        return array_map(function($post) {
            return new Post($post);
        }, $result->fetch_all(MYSQLI_ASSOC));
    }

    public function jsonSerialize(): array
    {
        return $this->posts;
    }

}

