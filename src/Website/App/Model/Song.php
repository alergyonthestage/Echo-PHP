<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Website\App\Model\Exceptions\SongNotFound;

use Exception;
use JsonSerializable;

class Song implements JsonSerializable {

    private function __construct(
        private array $song
    ) {
        $this->song['artist'] = Artist::fromID($song['id_artist']);
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

        return $song;  
    }

    public function getID(): string 
    {
        return $this->song['id_song'];
    }

    public function getTitle(): string 
    {
        return $this->song['title'];
    }

    public function getCoverArt(): string 
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
            throw new Exception("Database Error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new Exception('No song found');
        }
        $songs = $result->fetch_all(MYSQLI_ASSOC);
        $connection->close();
        return array_map(function($song) {
            return new static($song);
        }, $songs);
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getID(),
            'title' => $this->getTitle(),
            'artist' => $this->getArtist(),
            'coverArt' => $this->getCoverArt()
        ];
    }
}