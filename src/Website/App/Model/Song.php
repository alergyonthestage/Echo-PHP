<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Application\Configurations;
use Exception;
use stdClass;

class Song {

    private stdClass $song;

    private function __construct(stdClass $song) {
        $this->$song = $song;
    }

    public static function fromID(int $id) {
        return new static(static::fetch($id));
    }

    private static function fetch($song_id): stdClass{
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM song WHERE id_song = ?");
        $stmt->bind_param('i', $song_id);
        if(!$stmt->execute()){
            throw new Exception("Song not found: $song_id");
        }
        $song = $stmt->get_result()->fetch_object();
        $connection->close(); 

        //Fetch the artist from DB by artist_id
        $artist = Artist::fromID($song->getArtistID());
        $song->artist = $artist;

        return $song;  
    }

    public function getSongID(): string {
        return $this->song->id_song;
    }

    public function getTitle(): string {
        return $this->song->title;
    }

    public function getCover(): string {
        return $this->song->cover;
    }

    public function getArtist(): string {
        return $this->song->artist;
    }

}