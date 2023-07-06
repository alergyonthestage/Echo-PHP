<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\User;
use CaveResistance\Echo\Server\Application\Configurations;

class UserController implements Controller {

    public function index($username): Response
    {
        $user = User::fromUsername($username);

        $userData = [
            'username' => $user->getUsername(),
            'verified' => $user->isVerified(),
            'name' => $user->getName()." ".$user->getSurname(),
            'profileURI' => $user->getPic(),
            'echoes' => '1120',
            'posts' => '432',
            'friends' => $user->getFriendsCount(),
            'biography' => $user->getBio(),
            'selfProfile' => User::isLogged() ? $user->getUserID() === User::getLogged()->getUserID() : false,
            'relation' => $user->checkRelation(User::getLogged()->getUserID()),
        ];
        return (new ResponseBuilder())->setContent(View::render('user.user', $userData))->build();
    }

    public function signup(Request $request): Response
    {
        if($request->getMethod() == 'POST')
        {
            User::create(
                $request->getPostParam('username'),
                $request->getPostParam('name'),
                $request->getPostParam('surname'),
                $request->getPostParam('email'),
                $request->getPostParam('password')
            );
            Server::redirectTo("/user/".$request->getPostParam('username'));
        } else {
            return (new ResponseBuilder())->setContent(View::render('user.signup'))->build();
        }
    }

    public function login(Request $request): Response
    {
        if($request->getMethod() == 'POST')
        {
            if((User::fromUsername($request->getPostParam('username')))->login($request->getPostParam('password'))){
                Server::redirectTo("/user/".$request->getPostParam('username'));
            } else {
                Server::redirectTo("/login");
            }
        } else {
            return (new ResponseBuilder())->setContent(View::render('user.login'))->build();
        }
    }

    public function logout(): void
    {
        User::logout();
        Server::redirectTo('/login');
    }

    public function editProfile(Request $request): Response
    {
        $user = User::getLogged();
    
        if ($request->getMethod() == 'POST') {

            if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                // Handle file upload error, e.g., show an error message or redirect to a different page.
                return (new ResponseBuilder())->setContent('Error: File upload failed.')->build();
            }
            
            $file = $_FILES['file'];
            
            $allowedExtensions = ['jpeg', 'png'];
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
            
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            if (!in_array($fileExtension, $allowedExtensions) || !in_array($file['type'], $allowedMimeTypes) || $file['size'] > (5 * 1024 * 1024)) {
                // Error: Invalid file format or size.
                return (new ResponseBuilder())->setContent('Error: Invalid file format or size.')->build();
            }
    
            $fileName = $user->getUserID() . "." . $fileExtension;
            
            $destinationDir = Configurations::get('paths.profile_pic');
            $destination = $destinationDir.$fileName;

            if(is_dir($destinationDir) === false) {
                mkdir($destinationDir, 0777, true);
            }
            
            $moved = move_uploaded_file($file['tmp_name'], Configurations::get('public')."/img/profiles/$fileName");

            if(!$moved) {
                return (new ResponseBuilder())->setContent('Error: File upload failed.')->build();
            } else {
                return (new ResponseBuilder())->setContent('Move successful.')->build();
            }

            $user->updateProfileImage($fileName);
    
            Server::redirectTo("/user/" . $user->getUsername());

        } else {

            $userData = [
                'username' => $user->getUsername(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'biography' => $user->getBio(),
                'profileURI' => $user->getPic(),
                'email' => $user->getEmail(),
            ];
    
            return (new ResponseBuilder())->setContent(View::render('user.editprofile', $userData))->build();
        }
    }

    public function edit(Request $request): Response
    {
        $user = User::getLogged();

        if ($request->getMethod() == 'POST') {
            $user->update(
                $request->getPostParam('username'),
                $request->getPostParam('name'),
                $request->getPostParam('surname'),
                $request->getPostParam('biography'),
                $request->getPostParam('email'),
                $request->getPostParam('password')
            );
            
            Server::redirectTo("/user/" . $user->getUsername());
            //return (new ResponseBuilder())->setContent('Update successful.')->build();

        } else {
            $userData = [
                'username' => $user->getUsername(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'biography' => $user->getBio(),
                'profileURI' => $user->getPic(),
                'email' => $user->getEmail(),
            ];

            return (new ResponseBuilder())->setContent(View::render('user.edit', $userData))->build();
        }
    }

    public function addFriend(Request $request): void {
        $user = User::getLogged();
        $friend = User::fromID($request->getPostParam('friend'));
        $user->addFriend($friend->getUserID());
        Server::redirectTo("/user/" . $friend->getUsername());
    }
}
