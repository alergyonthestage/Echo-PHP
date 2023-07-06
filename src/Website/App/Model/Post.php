<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use CaveResistance\Echo\Website\App\Model\Comment;
use CaveResistance\Echo\Website\App\Model\User;
use Exception;
use stdClass;

class Post {

    private stdClass $post;

    private function __construct(stdClass $post) {
        $this->post = $post;
    }

    public static function fromID(int $id) {
        return new static(static::fetch($id));
    }

    public static function create(string $description, string $public, string $id_user, string $id_song): Post {
        $connection = Database::connect();
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $stmt = $connection->prepare("INSERT INTO post (description, date, time, public, id_user, id_song) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('sssssi', $description, $date, $time, $public, $id_user, $id_song);
        if (!$stmt->execute()) {
            throw new Exception("Cannot create post");
        }
        $id = $stmt->insert_id;
        $connection->close();
        return static::fromID($id);
    }

    private static function fetch($id_post): stdClass{
        $connection = Database::connect();

        //Fetch the post from DB by post_id
        $stmt = $connection->prepare("SELECT * FROM post WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if(!$stmt->execute()){
            throw new Exception("Post not found: $id_post");
        }
        $post = $stmt->get_result()->fetch_object();

        //Fetch the song from DB by song_id
        $song = Song::fromID($post->id_post);
        $post->song = $song;

        //Fetch the user author from DB by song_id
        $user = User::fromID($post->id_user);
        $post->author = $user;
        
        return $post;  
    }

    private function fetchComments(): array{
        $connection = Database::connect();

        $id_post = $this->post->id_post;
        //Fetch the comments from DB for this post by post_id
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if(!$stmt->execute()){
            throw new Exception("Comments not found for this post: $id_post");
        }
        $results = $stmt->get_result()->fetch_all();

        $comments = [];
        foreach($results as $result){ array_push($comments, Comment::fromArray($result)); }
        return $comments;
    }

    public function getComments(): array{
        return $this->fetchComments();
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
        $date_time = $this->getDate() . " " . $this->getTime();
        $date_time = strtotime($date_time);
        $current_date_time = strtotime(date("Y-m-d H:i:s"));
        $time_ago = $current_date_time - $date_time;
        $time_ago = round($time_ago / 60);
        if ($time_ago < 60) {
            return $time_ago . " min ago";
        } else if ($time_ago < 1440) {
            $time_ago = round($time_ago / 60);
            return $time_ago . " hours ago";
        }else if ($time_ago < 10080) {
            $time_ago = round($time_ago / 1440);
            return $time_ago . " days ago";
        }else if ($time_ago < 40320) {
            $time_ago = round($time_ago / 10080);
            return $time_ago . " weeks ago";
        }else if ($time_ago < 483840) {
            $time_ago = round($time_ago / 40320);
            return $time_ago . " months ago";
        }else if ($time_ago > 483840) {
            $time_ago = round($time_ago / 483840);
            return $time_ago . " years ago";
        }
    }

    public function isPublic(): string {
        return $this->post->public;
    }

    public function getAuthorUderID(): string {
        return $this->post->id_user;
    }

    public function getAuthorUsername(): string {
        return $this->post->author->getUsername();
    }

    public function isAuthorVerified(): string {
        return $this->post->author->isVerified();
    }

    public function getAuthorPicture(): string {
        return $this->post->author->getPic();
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

    public function addLike(): void {
        if($this->loggedLike()){
            $query = "DELETE FROM likedpost WHERE id_post = ? AND id_user = ?;";
        } else{
            $query = "INSERT INTO likedpost (id_post, id_user) VALUES (?,?)";
        }
        $connection = Database::connect();
        $id_post = $this->getPostID();  
        $id_user = User::getLogged()->getUserID();
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ii', $id_post, $id_user);
        if (!$stmt->execute()) {
            throw new Exception("Cannot modified like");
        }
        $connection->close();
    }

    public function loggedLike() : bool {
        $connection = Database::connect();
        $id_post = $this->getPostID();
        $id_user = User::getLogged()->getUserID();
        $stmt = $connection->prepare("SELECT * FROM likedpost WHERE id_post = ? AND id_user = ?");
        $stmt->bind_param('ii', $id_post, $id_user);
        if (!$stmt->execute()) {
            throw new Exception("Cannot check like");
        }
        $result = $stmt->get_result()->fetch_object();
        $connection->close();
        return $result != null;
    }
}
