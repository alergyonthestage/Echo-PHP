<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class UserNotFound extends Exception {

    private string|int $user;

    public function __construct(string|int $user, $code = 0, Throwable $previous = null) 
    {
        $this->user = $user;
        parent::__construct("The user ".$this->user." was not found on Echo servers.", $code, $previous);
    }
    
    public function getUser() {
        return $this->user;
    }

}