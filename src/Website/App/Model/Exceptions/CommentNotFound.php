<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class CommentNotFound extends Exception {

    private int $postID;
    private int $userID;
    private string $date;
    private string $time;

    public function __construct(int $postID, int $userID, string $date, string $time, $code = 0, Throwable $previous = null) 
    {
        $this->postID = $postID;
        $this->userID = $userID;
        $this->date = $date;
        $this->time = $time;
        parent::__construct("The comment was not found on Echo servers.", $code, $previous);
    }

    public function getPostID() {
        return $this->postID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }
}   