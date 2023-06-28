<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;
use CaveResistance\Echo\Server\Application\Configurations;

class User {

    private static string $login_sess_var_name = 'user_id';

    private stdClass $user;

    public function __construct(string $username) 
    {
        $this->fetch($username);
    }

    public static function create(string $username, string $name, string $surname, string $email, string $password)
    {
        $connection = Database::connect();
        $stmt = $connection->prepare("INSERT INTO user (username, name, surname, email, password) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $username, $name, $surname, $email, $password);
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
        return $this->user->verified === 0 ? $this->user->username : $this->user->username." ".Configurations::get('user.verified_suffix');        
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
        } else if($this->user->password === $this->getPassword()) {
            Session::setVariable(static::$login_sess_var_name, $this->getUserID());
            return true;
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        return Session::hasVariable(static::$login_sess_var_name) && Session::getVariable(static::$login_sess_var_name) === $this->getUserID();
    }

    public function logout(): void
    {
        Session::unsetVariable(static::$login_sess_var_name);
    }

}
