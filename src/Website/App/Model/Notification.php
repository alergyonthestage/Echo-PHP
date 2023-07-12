<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Website\App\Model\Exceptions\NotificationNotFound;
use Exception;
use JsonSerializable;

class Notification implements JsonSerializable {
    
    private function __construct(
        private array $notification
    ) {
        $this->notification['sender'] = User::fromID($notification['id_sender']);
    }

    public static function getUserNotifications($id_user): array
    {
        return Notification::fromRecepient($id_user);
    }

    private static function fromRecepient($userID): array 
    {
        $connection = Database::connect();

        //Fetch the notifications from DB for this recepient_id
        $stmt = $connection->prepare("SELECT * FROM notification WHERE id_recipient = ?");
        $stmt->bind_param('i', $userID);
        if(!$stmt->execute()) {
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) === 0) {
            return [];
        }

        $notifications = $result->fetch_all(MYSQLI_ASSOC);
        return array_map(function($notification) {
            return new static($notification);
        }, $notifications);
    }

    public static function fromNotificationID(int $id) 
    {
        return new static(static::fetch($id));
    }

    public static function createCommentNotification($sender, $post_id): void
    {
        static::create($sender, Post::fromID($post_id)->getAuthor()->getID(), $post_id, 1);
    }

    public static function createLikeNotification($sender, $post_id): void
    {
        static::create($sender, Post::fromID($post_id)->getAuthor()->getID(), $post_id, 2);
    }

    public static function createFriendRequestNotification($sender, $recipient): void
    {
        static::create($sender, $recipient, null, 3);
    }

    public static function createFriendAcceptedRequestNotification($sender, $recipient): void
    {
        static::create($sender, $recipient, null, 4);
    }

    public static function createFriendRejectedRequestNotification($sender, $recipient): void
    {
        static::create($sender, $recipient, null, 5);
    }

    public static function getUserNotificationsCount($id_user, $retrieveUnred): int
    {
        return static::fetchUserNotificationsCount($id_user,  $retrieveUnred);
    }

    private static function fetch($notification_id): array
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM notification WHERE id_notification = ?");
        $stmt->bind_param('i', $notification_id);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) === 0) {
            throw new NotificationNotFound($notification_id);
        }
        $notification = $result->fetch_array();
        $connection->close(); 
        return $notification;
    }

    private static function create($sender, $recipient, $post_id, $type_id): void
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("INSERT INTO notification (id_sender, id_recipient, id_post, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiii', $sender, $recipient, $post_id, $type_id);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $connection->close(); 
    }

    private static function fetchUserNotificationsCount($id_user, $retrieveUnred): int
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM notification WHERE id_recipient = ? AND to_read = ?");
        $stmt->bind_param('ii', $id_user, $retrieveUnred);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        $connection->close(); 
        return $result->fetch_row()[0];
    }

    public function getID(): string 
    {
        return $this->notification['id_notification'];
    }

    public function getTimestamp(): string 
    {
        return $this->notification['timestamp'];
    }

    public function getSenderID(): string 
    {
        return $this->notification['id_sender'];
    }

    public function getSender(): User 
    {
        return $this->notification['sender'];
    }

    public function getRecipientID(): string 
    {
        return $this->notification['id_recipient'];
    }

    public function getPostID(): string 
    {
        return $this->notification['id_post'];
    }

    public function isToRead(): bool 
    {
        return $this->notification['to_read'];
    }

    public function getTypeID(): int 
    {
        return $this->notification['type'];
    }

    public function getTypeDescription(): string 
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT description FROM notificationtype WHERE id_type = ?");
        $typeID = $this->getTypeID();
        $stmt->bind_param('i', $typeID);
        if(!$stmt->execute()){
            throw new Exception("Database error");
        }
        $result = $stmt->get_result();
        $connection->close();
        return $result->fetch_row()[0];
    }

    public function jsonSerialize(): array
    {
        return [
            'notification_id' => $this->getID(),
            'timestamp' => $this->getTimestamp(),
            'sender_id' => $this->getSenderID(),
            'sender' => $this->getSender(),
            'recipient_id' => $this->getRecipientID(),
            'post_id' => $this->getPostID(),
            'to_read' => $this->isToRead(),
            'type_id' => $this->getTypeID()
        ];
    }


}