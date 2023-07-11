<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Website\App\Model\Exceptions\ArtistNotFound;
use Exception;

class Artist {

    private array $artist;

    private function __construct(array $artist) {
        $this->artist = $artist;
    }

    public static function fromID(int $id) {
        return new static(static::fetch($id));
    }

    private static function fetch($artist_id): array{
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM artist WHERE id_artist = ?");
        $stmt->bind_param('i', $artist_id);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new ArtistNotFound($artist_id);
        }
        $artist = $result->fetch_array();
        $connection->close(); 
        return $artist;
    }

    public function getArtistID(): string {
        return $this->artist['id_artist'];
    }

    public function getStageName(): string {
        return $this->artist['stage_name'];
    }

    public function getPic(): string {
        if ($this->artist['pic'] === NULL || $this->artist['pic']  === '') {
            return Configurations::get('paths.artist_pic').'default.png';
        } else {
            return Configurations::get('paths.artist_pic').$this->artist['pic'];
        }
    }

}