<?php

namespace CaveResistance\Echo\Server\Routing\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception {

    private string $path;

    public function __construct(string $path, $code = 0, Throwable $previous = null) 
    {
        $this->path = $path;
        parent::__construct("No Route matches ".$this->path, $code, $previous);
    }
    
    public function getPath() {
        return $this->path;
    }

}