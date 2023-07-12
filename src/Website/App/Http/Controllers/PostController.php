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
            'comments' => $post->getComments(),
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
                empty($request->getPostParam('share_only_friends')),
                User::getLogged()->getID(),
                $request->getPostParam('song_id')
            );
            return Server::redirectTo("/feed");
        } else {
            return (new ResponseBuilder())->setContent(View::render('post.publish'))->build();
        }
    }


    public function addLike(Request $request): Response
    {   
        $post = Post::fromID((int) $request->getPostParam('id_post'));
        $post->toggleLike();
        return Server::redirectTo("/post/".$post->getID());
    }

    public function publishComment(Request $request): Response
    {
        $comment = Comment::create(
            (int) $request->getPostParam('id_post'),
                User::getLogged()->getID(),
                $request->getPostParam('text'),
            );
            return Server::redirectTo("/post/".$comment->getPost());
    }
}