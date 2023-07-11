<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Exceptions\CommentNotFound;
use Exception;
use mysqli;
use stdClass;

class Comment {

    private stdClass $comment;

    private function __construct(stdClass $comment) {
        $this->comment = $comment;
    }

    public static function fromKeys(int $id_post, int $id_user, string $timestamp): Comment {
        return new static(static::fetch($id_post, $id_user, $timestamp));
    }

    public static function fromArray(array $comment): Comment {
        return new static(static::createFromArray($comment));
    }

    private static function createFromArray(array $array): stdClass {
        $comment = new stdClass();
        $comment->id_post = $array[0];
        $comment->id_user = $array[1];
        $comment->timestamp = $array[2];
        $comment->text = $array[3];
        $user = User::fromID($comment->id_user);
        $comment->author = $user;
        return $comment;
    }

    private static function fetch(int $id_post, int $id_user, string $timestamp): stdClass{
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
        $comment = $result->fetch_object();
        //Fetch the user author from DB by id_user
        $user = User::fromID($comment->id_user);
        $comment->author = $user;
        
        return $comment;  
    }

    
    public static function create(int $id_post, int $id_user, string $text){
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
        $connection->close();
        return static::fromKeys($id_post, $id_user, $timestamp);
    }

    public function getCommentID(): string {
        return $this->comment->id_comment;
    }

    public function getPostID(): string {
        return $this->comment->id_post;
    }

    public function getUserID(): string {
        return $this->comment->id_user;
    }

    public function getUsername(): string {
        return $this->comment->author->getUsername();
    }

    public function getPic(): string {
        return $this->comment->author->getPic();
    }

    public function getDate(): string 
    {
        return date("Y-m-d", strtotime($this->comment->timestamp));
    }

    public function getTime(): string 
    {
        return date("H:i:s", strtotime($this->comment->timestamp));
    }

    public function getTimestamp(): string {
        return $this->comment->timestamp;
    }

    public function getTimeAgo(): string {
        $timestamp = strtotime($this->comment->timestamp);
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

    public function getText(): string {
        return $this->comment->text;
    }


}