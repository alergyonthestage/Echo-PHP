<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\Post;
use CaveResistance\Echo\Website\App\Model\User;
use CaveResistance\Echo\Website\App\Model\Comment;

class PostController implements Controller {

    public function index($id): Response
    {
        $post = Post::fromID($id);
        $data = [
            'comments' => $post->getComments(0),
            'id' => $post->getID()
        ];
        return (new ResponseBuilder())->setContent(View::render('post.post', $data))->build();
    }

    public function publish(Request $request): Response
    {
        if($request->getMethod() === 'POST')
        {
            Post::create(
                $request->getPostParam('description'),
                User::getLogged()->getID(),
                $request->getPostParam('song-id')
            );
            return Server::redirectTo("/feed");
        } else {
            return (new ResponseBuilder())->setContent(View::render('post.publish'))->build();
        }
    }

    
}