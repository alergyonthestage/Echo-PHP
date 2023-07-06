<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class PostNotFound extends Exception {

    private int $post;

    public function __construct(int $post, $code = 0, Throwable $previous = null) 
    {
        $this->post = $post;
        parent::__construct("The post ".$this->post." was not found on Echo servers.", $code, $previous);
    }
    
    public function getPost() {
        return $this->post;
    }

}