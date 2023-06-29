<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use Exception;
use stdClass;

class Post {

    private stdClass $post;

    private function __construct(stdClass $post) {
        $this->$post = $post;
    }

    public static function fromID(int $id) {
        return new static(static::fetch($id));
    }

    public static function create(string $description, string $public, string $id_user, string $id_song) {
        $connection = Database::connect();
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $stmt = $connection->prepare("INSERT INTO post (description, date, time, public, id_user, id_song) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('sssssi', $description, $date, $time, $public, $id_user, $id_song);
        if (!$stmt->execute()) {
            throw new Exception("Cannot create post");
        }
        $connection->close();
    }

    private static function fetch($post_id): stdClass{
        $connection = Database::connect();

        //Fetch the post from DB by post_id
        $stmt = $connection->prepare("SELECT * FROM post WHERE post_id = ?");
        $stmt->bind_param('i', $post_id);
        if(!$stmt->execute()){
            throw new Exception("Post not found: $post_id");
        }
        $post = $stmt->get_result()->fetch_object();

        //Fetch the song from DB by song_id
        $song = Song::fromID($post->id_song);
        $post->song = $song;
        
        return $post;  
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

    public function getTimeAgo(): string {
        return "TODO";
    }

    public function isPublic(): string {
        return $this->post->public;
    }

    public function getAuthorUderID(): string {
        return $this->post->id_user;
    }

    public function getAuthorUsername(): string {
        return "TODO";
    }

    public function getAuthorBadges(): string {
        return "TODO";
    }

    public function getAuthorPicture(): string {
        return "TODO";
    }

    public function getSongID(): string {
        return $this->post->id_song;
    }

    public function getSongTitle(): string {
        return $this->post->song->getTitle();
    }

    public function getSongCover(): string {
        return $this->post->song->getCover();
    }

    public function getSongArtist(): string {
        return $this->post->song->getArtist()->getStageName();
    }

}
