<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Application\Configurations;
use Exception;

class Song {

    private array $song;

    private function __construct(array $song) 
    {
        $this->song = $song;
    }

    public static function fromID(int $id) 
    {
        return new static(static::fetch($id));
    }

    private static function fetch($song_id): array
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM song WHERE id_song = ?");
        $stmt->bind_param('i', $song_id);
        if(!$stmt->execute()){
            throw new Exception("Song not found: $song_id");
        }
        $song = $stmt->get_result()->fetch_array();
        $connection->close(); 

        //Fetch the artist from DB by artist_id
        $artist = Artist::fromID($song['id_artist']);
        //TO-DO: non mi piace molto che il modello della song tenga anche l'artista. Meglio solo getArtistID()
        $song['artist'] = $artist;

        return $song;  
    }

    public function getSongID(): string 
    {
        return $this->song['id_song'];
    }

    public function getTitle(): string 
    {
        return $this->song['title'];
    }

    public function getCover(): string 
    {
        return Configurations::get('paths.cover_art').$this->song['cover'];
    }

    public function getArtist(): Artist 
    {
        return $this->song['artist'];
    }

    public static function search(string $searchString): array 
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM song WHERE title LIKE ?");
        $search = "%$searchString%";
        $stmt->bind_param('s', $search);
        if(!$stmt->execute()){
            throw new Exception("Error while searching: $searchString");
        }
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $connection->close();
        return array_map(function($songArray) {
            return new static($songArray);
        }, $result);
    }

    public function toJson(): string
    {
        return json_encode($this->song);
    }

}