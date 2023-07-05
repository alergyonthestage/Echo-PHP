<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use Exception;
use stdClass;

class Comment {

    private stdClass $comment;

    private function __construct(stdClass $comment) {
        $this->comment = $comment;
    }

    public static function fromKeys(int $id_post, int $id_user, string $date, string $time): Comment {
        return new static(static::fetch($id_post, $id_user, $date, $time));
    }

    private static function fetch(int $id_post, int $id_user, string $date, string $time): stdClass{
        $connection = Database::connect();

        //Fetch the comment from DB by id_comment
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ? AND id_user = ? AND date = ? AND time = ?");
        $stmt->bind_param('iiss', $id_post, $id_user, $date, $time);
        if(!$stmt->execute()){
            throw new Exception("Comment not found: $id_post, $id_user, $date, $time");
        }
        $comment = $stmt->get_result()->fetch_object();

        //Fetch the user author from DB by id_user
        $user = User::fromID($comment->id_user);
        $comment->author = $user;
        
        return $comment;  
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
        return "TODO";
    }

    public function getText(): string {
        return $this->comment->text;
    }


}