<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Post;

class PostController implements Controller {

    public function getPostData(int $id): Response 
    {
        $post = Post::fromID($id);
        return (new ResponseBuilder())->setContent(json_encode($post))->setMimeType('application/json')->build();
    }

    public function addLike(Request $request): Response 
    {
        $post = Post::fromID($request->getPostParam('post-id'));
        $post->addLike();
        return (new ResponseBuilder())->setContent(json_encode($post))->setMimeType('application/json')->build();
    }
}