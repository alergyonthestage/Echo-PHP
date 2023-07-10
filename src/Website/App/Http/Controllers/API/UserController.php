<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Website\App\Model\User;

class UserController {

    public function editAvatar(Request $request): Response
    {
        $user = User::getLogged();

        if (!isset($request->getFiles()['avatar']) || $request->getFiles()['avatar']['error'] !== UPLOAD_ERR_OK) {
            return (new ResponseBuilder())->setContent('Error: File upload failed.')->build();
        }
        
        $file = $request->getFiles()['avatar'];
        
        $allowedExtensions = ['jpeg', 'png'];
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions) || !in_array($file['type'], $allowedMimeTypes) || $file['size'] > (5 * 1024 * 1024)) {
            // Error: Invalid file format or size.
            return (new ResponseBuilder())->setContent('Error: Invalid file format or size.')->build();
        }

        $fileName = $user->getUserID().".".$fileExtension;
        $destinationPath = Configurations::get('public')."/img/profiles/";

        if(move_uploaded_file($file['tmp_name'], $destinationPath.$fileName)) {
            return (new ResponseBuilder())->setContent('Move successful.')->build();
        } else {
            return (new ResponseBuilder())->setContent("Cannot move file")->build();
        }

        $user->updateProfileImage($fileName);

        Server::redirectTo("/user/" . $user->getUsername());
    }

    public function addFriend(Request $request): void 
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->addFriend($friend->getUserID());
    }
}