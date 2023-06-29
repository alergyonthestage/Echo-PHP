<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Server\View\View;
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
            'echoes' => '1120',
            'posts' => '432',
            'friends' => '982',
            'biography' => $user->getBio(),
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

}