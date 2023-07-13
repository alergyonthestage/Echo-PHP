<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers\API;

use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Request;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Website\App\Model\Post;
use CaveResistance\Echo\Website\App\Model\Report;
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
}