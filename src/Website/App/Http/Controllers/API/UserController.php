<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Report;
use CaveResistance\Echo\Website\App\Model\User;

class UserController {

    public function editAvatar(Request $request): Response
    {
        $allowedExtensions = ['jpeg', 'png', 'jpg'];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxFileSize = 5 * 1024 * 1024;

        $user = User::getLogged();
        
        $file = $request->getFiles()['avatar'];

        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, 'Error: File upload failed.'))
            )->build();
        }
        
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if($file['size'] > ($maxFileSize)) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, "Error: Choose a file smaller than $maxFileSize bytes."))
            )->build();
        }
        
        if (!in_array($fileExtension, $allowedExtensions) || !in_array($file['type'], $allowedMimeTypes)) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, 'Error: Invalid file format.'))
            )->build();
        }

        $fileName = $user->getUserID().".".$fileExtension;
        $destinationPath = Configurations::get('public')."/img/profiles/";

        if(!move_uploaded_file($file['tmp_name'], $destinationPath.$fileName)) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, 'Error: Cannot move file.'))
            )->build();
        }
        
        $user->updateProfileImage($fileName);

        return (new ResponseBuilder())->setJsonContent(
            json_encode(new Report(true, 'Success: Avatar updated!'))
        )->build();
    }

    public function addFriend(Request $request): void 
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->addFriend($friend->getUserID());
    }

    public function removeFriend(Request $request):  void
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->removeFriend($friend->getUserID());
    }

    public function cancelFriendRequest(Request $request): void
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->cancelFriendRequest($friend->getUserID());
    }

    public function declineFriendRequest(Request $request): void 
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->declineFriendRequest($friend->getUserID());    
    }

    
    public function acceptFriendRequest(Request $request): void 
    {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->acceptFriendRequest($friend->getUserID());
    }
}