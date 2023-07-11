<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Website\App\Model\Exceptions\SongNotFound;

use Exception;
use JsonSerializable;
use mysqli;

class Song implements JsonSerializable {

    private array $song;

    private function __construct(array $song) 
    {
        $song['artist_name'] = Artist::fromID($song['id_artist'])->getStageName();
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
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new SongNotFound($song_id);
        }
        $song = $result->fetch_array();
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

    public function getArtistID(): int 
    {
        return $this->song['id_artist'];
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
            throw new Exception("Database Error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new Exception('No song found');
        }
        $songs = $result->fetch_all(MYSQLI_ASSOC);
        $connection->close();
        return array_map(function($songArray) {
            return new static($songArray);
        }, $songs);
    }

    public function jsonSerialize(): array
    {
        return $this->song;
    }
}