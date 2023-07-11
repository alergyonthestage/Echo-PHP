<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class CommentNotFound extends Exception {

    private int $postID;
    private int $userID;
    private string $timestamp;

    public function __construct(int $postID, int $userID, string $timestamp, $code = 0, Throwable $previous = null) 
    {
        $this->postID = $postID;
        $this->userID = $userID;
        $this->timestamp = $timestamp;
        parent::__construct("The comment was not found on Echo servers.", $code, $previous);
    }

    public function getPostID() {
        return $this->postID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }
}   