<?php

namespace CaveResistance\Echo\Website\App\Model\Exceptions;

use Exception;
use Throwable;

class NotificationNotFound extends Exception {

    private int $NotificationID;

    public function __construct(int $NotificationID, $code = 0, Throwable $previous = null) 
    {
        $this->NotificationID = $NotificationID;
        parent::__construct("The Notification ".$this->NotificationID." was not found on Echo servers.", $code, $previous);
    }
    
    public function getNotificationID() {
        return $this->NotificationID;
    }

}