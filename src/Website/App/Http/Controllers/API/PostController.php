<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Post;
use CaveResistance\Echo\Website\App\Model\Report;
use CaveResistance\Echo\Website\App\Model\Comment;
use CaveResistance\Echo\Website\App\Model\User;
use Exception;

class PostController implements Controller {

    public function getPostData(int $id): Response 
    {
        $post = Post::fromID($id);
        return (new ResponseBuilder())->setJsonContent(json_encode($post))->build();
    }

    public function toggleLike(Request $request): Response 
    {
        $post = Post::fromID($request->getPostParam('post-id'));
        try {
            $post->toggleLike();
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Like updated'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }
        
    }

    public function getPostComments(Request $request, int $id): Response 
    {
        $post = Post::fromID($id);
        $quantity = $request->getQueryParam('qnt') ?? 0;
        return (new ResponseBuilder())->setJsonContent(json_encode($post->getComments($quantity)))->build();
    }

    public function publishComment(Request $request): Response
    {
        try {
            Comment::create(
                (int) $request->getPostParam('id_post'),
                    User::getLogged()->getID(),
                    $request->getPostParam('text'),
            );
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(true, 'Comment published successfully'))
            )->build();
        } catch (Exception $e) {
            return (new ResponseBuilder())->setJsonContent(
                json_encode(new Report(false, $e->getMessage()))
            )->build();
        }   
    }

    public function getUserPosts(int $id): Response
    {
        return (new ResponseBuilder())->setJsonContent(
            json_encode(Post::getUserPosts($id))
        )->build();
    }
}