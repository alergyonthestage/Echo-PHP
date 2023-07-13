<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\Notification;
use CaveResistance\Echo\Website\App\Model\User;

class NotificationsController implements Controller {

    public function index(): Response {
        $data = [
            'notifications_toread' => Notification::getUserNotifications(User::getLogged()->getID(), true),
            'notifications_read' => Notification::getUserNotifications(User::getLogged()->getID(), false)
        ];
        Notification::setAllRead(User::getLogged()->getID());
        return (new ResponseBuilder())->setContent(View::render('user.notifications', $data))->build();
    }
   

}