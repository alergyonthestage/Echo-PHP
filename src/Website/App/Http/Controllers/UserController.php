<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Http\Session;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\Exceptions\UserNotFound;
use CaveResistance\Echo\Website\App\Model\User;

class UserController implements Controller {

    public function index($username): Response
    {
        $user = User::fromUsername($username);

        $userData = [
            'username' => $user->getUsername(),
            'verified' => $user->isVerified(),
            'name' => $user->getName()." ".$user->getSurname(),
            'profileURI' => $user->getPic(),
            'echoes' => $user->getEchoesCount(),
            'posts' => $user->getPostsCount(),
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
            Session::unsetVariable('login_error');
            try {
                if((User::fromUsername($request->getPostParam('username')))->login($request->getPostParam('password'))){
                    Server::redirectTo("/user/".$request->getPostParam('username'));
                } else {
                    Session::setVariable('login_error', 'Incorrect password');
                    Server::redirectTo("/login");
                }  
            } catch (UserNotFound $userNotFound) {
                Session::setVariable('login_error', "The user ".$userNotFound->getUser()." was not found on Echo servers.");
                Server::redirectTo("/login");
            }
        } else {
            $errors = Session::hasVariable('login_error') ? ['error' => Session::getVariable('login_error')] : [];
            return (new ResponseBuilder())->setContent(View::render('user.login', $errors))->build();
        }
    }

    public function logout(): void
    {
        User::logout();
        Server::redirectTo('/login');
    }

    public function edit(Request $request): Response
    {
        $user = User::getLogged();
        
        if($request->getMethod() === 'POST') {
            $user->update(
                $request->getPostParam('username'),
                $request->getPostParam('name'),
                $request->getPostParam('surname'),
                $request->getPostParam('biography'),
                $request->getPostParam('email'),
                $request->getPostParam('password')
            );
            
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

            return (new ResponseBuilder())->setContent(View::render('user.edit', $userData))->build();
        }
        
    }
}
