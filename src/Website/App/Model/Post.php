<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Comment;
use CaveResistance\Echo\Website\App\Model\User;
use CaveResistance\Echo\Website\App\Model\Exceptions\PostNotFound;

use Exception;
use JsonSerializable;

class Post implements JsonSerializable {

    private array $post;

    public function __construct(array $post) 
    {
        //Fetch the song from DB by song_id
        $song = Song::fromID($post['id_song']);
        $post['song'] = $song;

        //Fetch the user author from DB by song_id
        $user = User::fromID($post['id_user']);
        $post['author'] = $user;

        $this->post = $post;
    }

    public static function fromID(int $id_post) 
    {
        return new static(static::fetch($id_post));
    }

    public static function getUserPostsCount(int $id_user): int 
    {
        return static::fetchUserPostsCount($id_user);
    }

    public static function create(string $description, string $public, string $id_user, string $id_song): Post 
    {
        $connection = Database::connect();
        $timestamp = date('Y-m-d H:i:s', time());
        $stmt = $connection->prepare("INSERT INTO post (description, timestamp, public, id_user, id_song) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('sssssi', $description, $timestamp, $public, $id_user, $id_song);
        if (!$stmt->execute()) {
            throw new Exception("Cannot create post");
        }
        $id = $stmt->insert_id;
        $connection->close();
        return static::fromID($id);
    }

    private static function fetch($id_post): array 
    {
        $connection = Database::connect();

        //Fetch the post from DB by post_id
        $stmt = $connection->prepare("SELECT * FROM post WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new PostNotFound($id_post);
        }
        $post = $result->fetch_array();
        
        $connection->close();
        return $post;  
    }

    private function fetchComments(): array 
    {
        $connection = Database::connect();

        $id_post = $this->post['id_post'];
        //Fetch the comments from DB for this post by post_id
        $stmt = $connection->prepare("SELECT * FROM comment WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if(!$stmt->execute()){
            throw new Exception("Comments not found for this post: $id_post");
        }
        $results = $stmt->get_result()->fetch_all();

        $comments = [];
        foreach($results as $result){ array_push($comments, Comment::fromArray($result)); }
        return $comments;
    }

    private static function fetchUserPostsCount($id_user): int
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT COUNT(*) AS post_count FROM post WHERE id_user = ?"); 
        $stmt->bind_param('i', $id_user);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        $post_count = $result->fetch_object()->post_count;
        $connection->close();
        return $post_count;
    }

    public function getComments(): array
    {
        return $this->fetchComments();
    }

    public function getPostID(): string 
    {
        return $this->post['id_post'];
    }

    public function getDescription(): string 
    {
        return $this->post['description'];
    }

    public function getDate(): string 
    {
        return date("Y-m-d", strtotime($this->post['timestamp']));
    }

    public function getTime(): string 
    {
        return date("H:i:s", strtotime($this->post['timestamp']));
    }

    public function getTimestamp(): string 
    {
        return $this->post['timestamp'];
    }

    public function getTimeAgo(): string 
    {
        $timestamp = strtotime($this->post['timestamp']);
        $now = time();
        $diff = $now - $timestamp;
        if($diff < 60) {
            return $diff . " seconds ago";
        }
        $diff = floor($diff / 60);
        if($diff < 60) {
            return $diff . " minutes ago";
        }
        $diff = floor($diff / 60);
        if($diff < 24) {
            return $diff . " hours ago";
        }
        $diff = floor($diff / 24);
        if($diff < 30) {
            return $diff . " days ago";
        }
        $diff = floor($diff / 30);
        if($diff < 12) {
            return $diff . " months ago";
        }
        $diff = floor($diff / 12);
        return $diff . " years ago";
    }

    public function isPublic(): string 
    {
        return $this->post['public'];
    }

    public function getAuthorUderID(): string 
    {
        return $this->post['id_user'];
    }

    public function getAuthorUsername(): string 
    {
        return $this->post['author']->getUsername();
    }

    public function isAuthorVerified(): string 
    {
        return $this->post['author']->isVerified();
    }

    public function getAuthorPicture(): string 
    {
        return $this->post['author']->getPic();
    }

    public function getSongID(): string 
    {
        return $this->post['id_song'];
    }

    public function getSongTitle(): string 
    {
        return $this->post['song']->getTitle();
    }

    public function getSongCover(): string 
    {
        return $this->post['song']->getCover();
    }

    public function getSongArtist(): string 
    {
        return $this->post['song']->getArtist()->getStageName();
    }

    public function toggleLike(): bool 
    {
        if($this->hasLoggedUserLike()){
            $query = "DELETE FROM likedpost WHERE id_post = ? AND id_user = ?;";
        } else{
            $query = "INSERT INTO likedpost (id_post, id_user) VALUES (?,?)";
        }
        $connection = Database::connect();
        $id_post = $this->getPostID();  
        $id_user = User::getLogged()->getUserID();
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ii', $id_post, $id_user);
        if (!$stmt->execute()) {
            throw new Exception("Cannot modified like");
        }
        $connection->close();
        return $this->hasLoggedUserLike();
    }

    public function hasLoggedUserLike() : bool 
    {
        $connection = Database::connect();
        $id_post = $this->getPostID();
        $id_user = User::getLogged()->getUserID();
        $stmt = $connection->prepare("SELECT * FROM likedpost WHERE id_post = ? AND id_user = ?");
        $stmt->bind_param('ii', $id_post, $id_user);
        if (!$stmt->execute()) {
            throw new Exception("Cannot check like");
        }
        $result = $stmt->get_result()->fetch_object();
        $connection->close();
        return $result != null;
    }

    public function getLikesCount(): int
    {
        $connection = Database::connect();
        $id_post = $this->getPostID();
        $stmt = $connection->prepare("SELECT COUNT(*) AS likes_count FROM likedpost WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if (!$stmt->execute()) {
            throw new Exception("Cannot count likes");
        }
        $result = $stmt->get_result()->fetch_object();
        $connection->close();
        return $result->likes_count;
    }

    public function getCommentsCount(): int
    {
        $connection = Database::connect();
        $id_post = $this->getPostID();
        $stmt = $connection->prepare("SELECT COUNT(*) AS comments_count FROM comment WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if (!$stmt->execute()) {
            throw new Exception("Cannot count comments");
        }
        $result = $stmt->get_result()->fetch_object();
        $connection->close();
        return $result->comments_count;
    }

    public function getEchoesCount(): int
    {
        return 0;
    }

    public function jsonSerialize(): array
    {
        $json_array = [
            'idPost' => $this->getPostID(),
            'description' => $this->getDescription(),
            'date' => $this->getDate(),
            'time' => $this->getTime(),
            'timeAgo' => $this->getTimeAgo(),
            'public' => $this->isPublic(),
            'idUser' => $this->getAuthorUderID(),
            'username' => $this->getAuthorUsername(),
            'verified' => $this->isAuthorVerified(),
            'profilePicture' => $this->getAuthorPicture(),
            'idSong' => $this->getSongID(),
            'title' => $this->getSongTitle(),
            'cover' => $this->getSongCover(),
            'artist' => $this->getSongArtist(),
            'likesCount' => $this->getLikesCount(),
            'commentsCount' => $this->getCommentsCount(),
            'echoesCount' => $this->getEchoesCount(),
            'liked' => $this->hasLoggedUserLike()
        ];
        return $json_array;
    }

}
