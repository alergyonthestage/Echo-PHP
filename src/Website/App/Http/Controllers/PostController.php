<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Server;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Website\App\Model\Post;

class PostController implements Controller {

    public function index($id): Response
    {
        $post = Post::fromID($id);

        $postData = [
            "author_username" => $post->getAuthorUsername(),
            "author_verified" => $post->isAuthorVerified(),
            "author_picture" => $post->getAuthorPicture(),
            "time_ago" => $post->getTimeAgo(),
            "cover_art" => $post->getSongCover(),
            "song_info" => $post->getSongTitle()." - ".$post->getSongArtist(),
            "description" => $post->getDescription()
        ];
        return (new ResponseBuilder())->setContent(View::render('post.post', $postData))->build();
    }

    public function publish(Request $request): Response
    {
        if($request->getMethod() == 'POST')
        {
            Post::create(
                $request->getPostParam('TODO'),
                $request->getPostParam('TODO'),
                $request->getPostParam('TODO'),
                $request->getPostParam('TODO')
            );
            Server::redirectTo("/post/".$request->getPostParam('post_id'));
        } else {
            return (new ResponseBuilder())->setContent(View::render('post.publish'))->build();
        }
    }
}