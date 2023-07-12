<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\Notification;
use CaveResistance\Echo\Website\App\Model\User;

class NotificationsController implements Controller {

    public function index($username): Response {

        $notifications = Notification::getUserNotifications(User::getLogged()->getID());
        return (new ResponseBuilder())->setContent(View::render('notifications', $notifications))->build();
    }
   

}