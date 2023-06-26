<?php

namespace CaveResistance\Echo\Website\App\Model;

use CaveResistance\Echo\Server\Database\Database;
use CaveResistance\Echo\Server\Http\Session;
use Exception;
use stdClass;

class User {

    private static string $login_sess_var_name;

    private stdClass $user;
    

    public function __construct($username) {
        $this->fetch($username);
    }

    private function fetch($username){
        $connection = Database::connect();
        $stmt = $connection->prepare("SELECT * FROM utente WHERE username = ?");
        $stmt->bind_param('s', $username);
        if(!$stmt->execute()){
            throw new Exception("User not found: $username");
        }
        $this->user = $stmt->get_result()->fetch_object();
        $connection->close();       
    }

    public function getName(): string {
        return $this->user->nome;
    }

    public function getUsername(): string {
        return $this->user->username;
    }

    public function login(string $password): bool 
    {
        if(Session::hasVariable(static::$login_sess_var_name)) {
            throw new Exception('Already Logged');
        } else if($this->user->password === $password) {
            //Session::setVariable(static::$login_sess_var_name, $this->getID());
            return true;
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        return true; //Session::hasVariable(static::$login_sess_var_name) && Session::getVariable(static::$login_sess_var_name) === $this->getID();
    }

    public function logout(): void
    {
        Session::unsetVariable(static::$login_sess_var_name);
    }

}
