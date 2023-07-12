<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Exceptions\CommentNotFound;
use Exception;
use JsonSerializable;

class Comment {

    private function __construct(
        private array $comment
    ) {
        $this->comment['author'] = User::fromID($this->comment['id_user']);
        $this->comment['post'] = Post::fromID($this->comment['id_post']);
    }

    public static function fromID(int $id_post, int $id_user, string $timestamp): Comment 
    {
        return new static(static::fetch($id_post, $id_user, $timestamp));
    }

    public static function fromPost($postID): array 
    {
        $connection = Database::connect();

        //Fetch the comments from DB for this post by post_id
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ?");
        $stmt->bind_param('i', $postID);
        if(!$stmt->execute()) {
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) === 0) {
            return [];
        }

        $comments = $result->fetch_all(MYSQLI_ASSOC);
        return array_map(function($comment) {
            return new static($comment);
        }, $comments);
    }

    private static function fetch(int $id_post, int $id_user, string $timestamp): array 
    {
        $connection = Database::connect();

        //Fetch the comment from DB by id_comment
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ? AND id_user = ? AND timestamp = ?");
        $stmt->bind_param('iis', $id_post, $id_user, $timestamp);

        if(!$stmt->execute()){
            throw new Exception("Database Error");
        }
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) === 0) {
            throw new CommentNotFound($id_post, $id_user, $timestamp);
        }

        return $result->fetch_array(MYSQLI_ASSOC);
    }

    
    public static function create(int $id_post, int $id_user, string $text): void
    {
        $connection = Database::connect();
        $timestamp = date('Y-m-d H:i:s', time());
        $stmt = $connection->prepare("INSERT INTO comment (id_post, id_user, timestamp, text) VALUES (?,?,?,?)");
        $stmt->bind_param('iiss', $id_post, $id_user, $timestamp, $text);
        if($text == "") {
            throw new Exception("Cannot create empty comment");
        }
        if (!$stmt->execute()) {
            throw new Exception("Cannot create comment");
        }
        Notification::createCommentNotification($id_user, $id_post);
        $connection->close();
    }

    public function getID(): string 
    {
        return $this->comment['id_comment'];
    }

    public function getPost(): Post 
    {
        return $this->comment['post'];
    }

    public function getAuthor(): User
    {
        return $this->comment['author'];
    }

    public function getDate(): string 
    {
        return date("Y-m-d", strtotime($this->comment['timestamp']));
    }

    public function getTime(): string 
    {
        return date("H:i:s", strtotime($this->comment['timestamp']));
    }

    public function getTimestamp(): string 
    {
        return $this->comment['timestamp'];
    }

    public function getTimeAgo(): string 
    {
        $timestamp = strtotime($this->comment['timestamp']);
        $now = time();
        $diff = $now - $timestamp;
        if($diff < 60) {
            return $diff . " secondi fa";
        }
        $diff = floor($diff / 60);
        if($diff < 60) {
            return $diff . " minuti fa";
        }
        $diff = floor($diff / 60);
        if($diff < 24) {
            return $diff . " ore fa";
        }
        $diff = floor($diff / 24);
        if($diff < 30) {
            return $diff . " giorni fa";
        }
        $diff = floor($diff / 30);
        if($diff < 12) {
            return $diff . " mesi fa";
        }
        $diff = floor($diff / 12);
        return $diff . " anni fa";

    }

    public function getText(): string 
    {
        return $this->comment['text'];
    }

}