<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class SongNotFound extends Exception {

    private int $song;

    public function __construct(int $song, $code = 0, Throwable $previous = null) 
    {
        $this->song = $song;
        parent::__construct("The song ".$this->song." was not found on Echo servers.", $code, $previous);
    }
    
    public function getSong() {
        return $this->song;
    }

}