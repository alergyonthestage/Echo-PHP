<?php

namespace CaveResistance\Echo\Server\Database;

use CaveResistance\Echo\Server\Application\Configurations;
use mysqli;

class Database {

    public static function connect() {
        return new mysqli(
            Configurations::get('database')['hostname'], 
            Configurations::get('database')['username'], 
            Configurations::get('database')['password'], 
            Configurations::get('database')['dbname']
        );
    }
}