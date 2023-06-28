<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;

class Post {

    private stdClass $post;

    public function __construct($post_id) {
        $this->fetch($post_id);
    }

    private function fetch($post_id){
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM post WHERE post_id = ?");
        $stmt->bind_param('i', $post_id);
        if(!$stmt->execute()){
            throw new Exception("Post not found: $post_id");
        }
        $this->post = $stmt->get_result()->fetch_object();
        $connection->close();       
    }

    public function getPostID(): string {
        return $this->post->id_post;
    }

    public function getDescription(): string {
        return $this->post->description;
    }

    public function getDate(): string {
        return $this->post->date;
    }

    public function getTime(): string {
        return $this->post->time;
    }

    public function isPublic(): string {
        return $this->post->public;
    }

    public function getIDUser(): string {
        return $this->post->id_user;
    }

    public function getIdSong(): string {
        return $this->post->id_song;
    }


}
