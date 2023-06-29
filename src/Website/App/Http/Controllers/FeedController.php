<?php

namespace CaveResistance\Echo\Website\App\Http\Controllers;

use CaveResistance\Echo\Server\Interfaces\Http\Controller;
use CaveResistance\Echo\Server\Interfaces\Http\Messages\Response;
use CaveResistance\Echo\Server\Http\Messages\ResponseBuilder;
use CaveResistance\Echo\Server\View\View;
use CaveResistance\Echo\Server\Application\Configurations;

class FeedController implements Controller {

    public function index(): Response
    {
        $posts = [
            array(
                "username" => "alergyonthestage",
                "badges" => "",
                "profile_picture" => Configurations::get('paths.profile_pic')."alergyonthestage.png",
                "time_ago" => "5 ore fa",
                "cover_art" => "/public/img/cover/1.jpg",
                "song_title" => "Into You - Ariana",
                "description" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua."
            ),
            array(
                "username" => "paul98",
                "badges" => "",
                "profile_picture" => "/public/img/profiles/paul98.png",
                "time_ago" => "6 ore fa",
                "cover_art" => "/public/img/cover/1.jpg",
                "song_title" => "Into You - Ariana",
                "description" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua."
            ),
            array(
                "username" => "echo",
                "badges" => "<i class='fas fa-check-circle' title='Profilo verificato'></i>",
                "profile_picture" => "/public/img/profiles/default.png",
                "time_ago" => "7 ore fa",
                "cover_art" => "/public/img/cover/1.jpg",
                "song_title" => "Into You - Ariana",
                "description" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua."
            )
        ];
        return (new ResponseBuilder())->setContent(View::render('feed', $posts))->build();
    }
}