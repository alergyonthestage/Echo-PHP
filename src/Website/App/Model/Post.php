<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Comment;
use CaveResistance\Echo\Website\App\Model\User;
use CaveResistance\Echo\Website\App\Model\Exceptions\PostNotFound;

use Exception;
use JsonSerializable;

class Post implements JsonSerializable {

    public function __construct(
        private array $post
    ) {
        $this->post['song'] = Song::fromID($post['id_song']);
        $this->post['author'] = User::fromID($post['id_user']);
    }

    public static function fromID(int $id_post) 
    {
        return new static(static::fetch($id_post));
    }

    public static function getUserPostsCount(int $id_user): int 
    {
        return static::fetchUserPostsCount($id_user);
    }

    public static function getUserPosts(int $id_user): array 
    {
        return static::fetchUserPosts($id_user);
    }

    public static function create(string $description, string $id_user, string $id_song): void 
    {
        $connection = Database::connect();
        $timestamp = date('Y-m-d H:i:s', time());
        $stmt = $connection->prepare("INSERT INTO post (description, timestamp, id_user, id_song) VALUES (?,?,?,?)");
        $stmt->bind_param('ssii', $description, $timestamp, $id_user, $id_song);
        if (!$stmt->execute()) {
            throw new Exception("Cannot create post");
        }
        $connection->close();
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
        $post = $result->fetch_array(MYSQLI_ASSOC);
        
        $connection->close();
        return $post;  
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

    private static function fetchUserPosts($id_user): array
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM post WHERE id_user = ?"); 
        $stmt->bind_param('i', $id_user);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        $posts = [];
        while($post = $result->fetch_array(MYSQLI_ASSOC)){
            $posts[] = new static($post);
        }
        $connection->close();
        return $posts;
    }

    public function getComments($quantity): array
    {
        return Comment::fromPost($this->getID(), $quantity);
    }

    public function getID(): string 
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

    public function getAuthor(): User 
    {
        return $this->post['author'];
    }

    public function getSong(): Song 
    {
        return $this->post['song'];
    }

    public function toggleLike(): bool
    {
        $connection = Database::connect();
        $postID = $this->getID();  
        $userID = User::getLogged()->getID();
        if($this->hasUserLike($userID)){
            $query = "DELETE FROM likedpost WHERE id_post = ? AND id_user = ?;";
        } else{
            $query = "INSERT INTO likedpost (id_post, id_user) VALUES (?,?)";
        }
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ii', $postID, $userID);
        if (!$stmt->execute()) {
            throw new Exception("Cannot modify like");
        }
        if($this->hasUserLike($userID)){
            Notification::createLikeNotification($userID, $postID);
        }
        $connection->close();
        return $this->hasUserLike($userID);
    }

    public function hasUserLike($userID) : bool 
    {
        $connection = Database::connect();
        $postID = $this->getID();
        $stmt = $connection->prepare("SELECT * FROM likedpost WHERE id_post = ? AND id_user = ?");
        $stmt->bind_param('ii', $postID, $userID);
        if (!$stmt->execute()) {
            throw new Exception("Cannot check like");
        }
        $result = $stmt->get_result();
        $connection->close();
        return mysqli_num_rows($result) > 0;
    }

    public function getLikesCount(): int
    {
        $connection = Database::connect();
        $id_post = $this->getID();
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
        $id_post = $this->getID();
        $stmt = $connection->prepare("SELECT COUNT(*) AS comments_count FROM comment WHERE id_post = ?");
        $stmt->bind_param('i', $id_post);
        if (!$stmt->execute()) {
            throw new Exception("Cannot count comments");
        }
        $result = $stmt->get_result()->fetch_object();
        $connection->close();
        return $result->comments_count;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getID(),
            'description' => $this->getDescription(),
            'date' => $this->getDate(),
            'time' => $this->getTime(),
            'timeAgo' => $this->getTimeAgo(),
            'author' => $this->getAuthor(),
            'song' => $this->getSong(),
            'likesCount' => $this->getLikesCount(),
            'commentsCount' => $this->getCommentsCount(),
            'liked' => $this->hasUserLike(User::getLogged()->getID())
        ];
    }

}
