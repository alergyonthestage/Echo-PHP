<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Website\App\Authentication\Password;

class User {

    private static string $session_user_id = 'user_id';
    private static string $session_username = 'username';

    private stdClass $user;

    private function __construct(stdClass $user)
    {
        $this->user = $user;
    }

    public static function fromUsername(string $username)
    {
        return new static(static::fetchFromUsername($username));
    }

    public static function fromID(int $id)
    {
        return new static(static::fetchFromID($id));
    }

    public static function create(string $username, string $name, string $surname, string $email, string $password)
    {
        $salt = '';
        $pepperID = 0;
        $encriptedPass = Password::hash(Password::season($password, $salt, $pepperID));
        $connection = Database::connect();
        $stmt = $connection->prepare("INSERT INTO user (username, name, surname, email, password, salt, pepper_id) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssssi', $username, $name, $surname, $email, $encriptedPass, $salt, $pepperID);
        if(!$stmt->execute()){
            throw new Exception("Cannot register user $username");
        }
        $connection->close();
    }

    private static function fetchFromID(string $id): stdClass 
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->bind_param('i', $id);
        if(!$stmt->execute()){
            throw new Exception("User ID not found: $id");
        }
        $user = $stmt->get_result()->fetch_object();
        $connection->close();
        return $user;
    }

    private static function fetchFromUsername(string $username)
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        if(!$stmt->execute()){
            throw new Exception("User not found: $username");
        }
        $user = $stmt->get_result()->fetch_object();
        $connection->close();
        return $user;
    }

    public function getUserID(): string 
    {
        return $this->user->id_user;
    }

    public function getUsername(): string 
    {
        return $this->user->username;
    }

    public function isVerified(): bool 
    {
        return $this->user->verified;
    }

    public function getName(): string 
    {
        return $this->user->name;
    }

    public function getSurname(): string 
    {
        return $this->user->surname;
    }
    
    public function getBio(): string 
    {
        return $this->user->bio ?? '';
    }

    private function getPassword(): string 
    {
        return $this->user->password;
    }

    private function getSalt(): string 
    {
        return $this->user->salt;
    }

    private function getPepperID(): int 
    {
        return $this->user->pepper_id;
    }

    public function getEmail(): string 
    {
        return $this->user->email;
    }

    public function getPic(): string 
    {
        
        if ($this->user->pic === NULL || $this->user->pic === '') {
            return Configurations::get('paths.profile')."default.png";
        } else {
            return Configurations::get('paths.profile').$this->user->pic;
        }
    }

    public function login(string $password): bool 
    {
        if(static::isLogged()) {
            throw new Exception('Already Logged');
        } else if(Password::verify($password, $this->getPassword(), $this->getSalt(), $this->getPepperID())) {
            Session::setVariable(static::$session_user_id, $this->getUserID());
            Session::setVariable(static::$session_username, $this->getUsername());
            return true;
        }
        return false;
    }

    public static function isLogged(): bool
    {
        if(Session::hasVariable(static::$session_user_id) && Session::hasVariable(static::$session_username)) {
            if(Session::getVariable(static::$session_user_id) === User::fromUsername(Session::getVariable(static::$session_username))->getUserID() && 
            Session::getVariable(static::$session_username) === User::fromID(Session::getVariable(static::$session_user_id))->getUsername()) {
                return true;
            } else {
                static::logout();
                new Exception('The user_id and the username does not match. User logged out!');
            }
        }
        return false;
    }

    public static function logout(): void
    {
        Session::unsetVariable(static::$session_user_id);
        Session::unsetVariable(static::$session_username);
    }

}
