<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;
use CaveResistance\Echo\Server\Application\Configurations;
use CaveResistance\Echo\Website\App\Authentication\Password;

class User {

    private static string $login_sess_var_name = 'user_id';

    private stdClass $user;

    public function __construct(string $username) 
    {
        $this->fetch($username);
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

    private function fetch(string $username)
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        if(!$stmt->execute()){
            throw new Exception("User not found: $username");
        }
        $this->user = $stmt->get_result()->fetch_object();
        $connection->close();
    }

    public function getUserID(): string 
    {
        return $this->user->id_user;
    }

    public function getUsername(): string 
    {
        return $this->user->username;
    }

    public function getBadges(): string 
    {
        return $this->user->verified === 0 ? "" : Configurations::get('user.verified_suffix');        
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
        if(Session::hasVariable(static::$login_sess_var_name)) {
            throw new Exception('Already Logged');
        } else if(Password::verify($password, $this->getPassword(), $this->getSalt(), $this->getPepperID())) {
            Session::setVariable(static::$login_sess_var_name, $this->getUserID());
            return true;
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        return Session::hasVariable(static::$login_sess_var_name) && Session::getVariable(static::$login_sess_var_name) === $this->getUserID();
    }

    public static function logout(): void
    {
        Session::unsetVariable(static::$login_sess_var_name);
    }

}
