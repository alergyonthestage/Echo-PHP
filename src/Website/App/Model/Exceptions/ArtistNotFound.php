<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class ArtistNotFound extends Exception {

    private int $ArtistID;

    public function __construct(int $ArtistID, $code = 0, Throwable $previous = null) 
    {
        $this->ArtistID = $ArtistID;
        parent::__construct("The Artist ".$this->ArtistID." was not found on Echo servers.", $code, $previous);
    }
    
    public function getArtistID() {
        return $this->ArtistID;
    }

}