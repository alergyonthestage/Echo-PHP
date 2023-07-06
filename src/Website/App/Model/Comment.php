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

    public static function fromKeys(int $id_post, int $id_user, string $date, string $time): Comment {
        return new static(static::fetch($id_post, $id_user, $date, $time));
    }

    public static function fromArray(array $comment): Comment {
        return new static(static::createFromArray($comment));
    }

    private static function createFromArray(array $array): stdClass {
        $comment = new stdClass();
        $comment->id_post = $array[0];
        $comment->id_user = $array[1];
        $comment->date = $array[2];
        $comment->time = $array[3];
        $comment->text = $array[4];
        $user = User::fromID($comment->id_user);
        $comment->author = $user;
        return $comment;
    }

    private static function fetch(int $id_post, int $id_user, string $date, string $time): stdClass{
        $connection = Database::connect();

        //Fetch the comment from DB by id_comment
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ? AND id_user = ? AND date = ? AND time = ?");
        $stmt->bind_param('iiss', $id_post, $id_user, $date, $time);
        if(!$stmt->execute()){
            throw new Exception("Database Error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new CommentNotFound($id_post, $id_user, $date, $time);
        }
        $comment = $result->fetch_object();
        //Fetch the user author from DB by id_user
        $user = User::fromID($comment->id_user);
        $comment->author = $user;
        
        return $comment;  
    }

    
    public static function create(int $id_post, int $id_user, string $text){
        $connection = Database::connect();
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $stmt = $connection->prepare("INSERT INTO comment (id_post, id_user, date, time, text) VALUES (?,?,?,?,?)");
        $stmt->bind_param('iisss', $id_post, $id_user, $date, $time, $text);
        if($text == "") {
            throw new Exception("Cannot create empty comment");
        }
        if (!$stmt->execute()) {
            throw new Exception("Cannot create comment");
        }
        $connection->close();
        return static::fromKeys($id_post, $id_user, $date, $time);
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

    public function getDate(): string {
        return $this->comment->date;
    }

    public function getTime(): string {
        return $this->comment->time;
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

    public function getText(): string {
        return $this->comment->text;
    }


}