<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Report;
use CaveResistance\Echo\Website\App\Model\User;
use Exception;
use stdClass;

class UserController {

    public function search(Request $request): Response
    {
        $result = User::search($request->getQueryParam('search'));
        return (new ResponseBuilder())->setJsonContent(json_encode($result))->build();
    }

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

        $fileName = $user->getID().".".$fileExtension;
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

    public function requestFriendship(Request $request): Response 
    {
        try {
            $user = User::getLogged();
            $friend = User::fromID($request->getPostParam('friend'));
            $user->requestFriendship($friend->getID());
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Success: Friend added!'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }

    public function acceptFriendship(Request $request): Response 
    {
        try {
            $user = User::getLogged();
            $friend = User::fromID($request->getPostParam('friend'));
            $user->acceptFriendship($friend->getID());
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Success: Request accepted!'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }

    public function dropFriendshipRequest(Request $request): Response
    {
        try {
           $user = User::getLogged();
            $friend = User::fromID($request->getPostParam('friend'));
            $user->dropFriendshipRequest($friend->getID()); 
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Success: Request cancelled!'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }

    public function declineFriendshipRequest(Request $request): Response 
    {
        try {
            $user = User::getLogged();
            $friend = User::fromID($request->getPostParam('friend'));
            $user->declineFriendshipRequest($friend->getID()); 
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Success: Request declined!'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }

    public function removeFriendship(Request $request):  Response
    {
        try {
            $user = User::getLogged();
            $friend = User::fromID($request->getPostParam('friend'));
            $user->removeFriendship($friend->getID());
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Success: Friend removed!'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }

    public function checkUsernameAvailable(Request $request): Response
    {
        try {
            $username = $request->getPostParam('username');
            $object = new stdClass();
            $object->available = User::checkUsernameAvailable($username);
            return (new ResponseBuilder())->setJsonContent(
                json_encode($object)
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
    }
}