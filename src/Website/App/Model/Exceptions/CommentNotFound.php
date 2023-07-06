<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class CommentNotFound extends Exception {

    private int $commentID;

    public function __construct(int $commentID, $code = 0, Throwable $previous = null) 
    {
        $this->commentID = $commentID;
        parent::__construct("The comment ".$this->commentID." was not found on Echo servers.", $code, $previous);
    }
    
    public function getCommentID() {
        return $this->commentID;
    }

}