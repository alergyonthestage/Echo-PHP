<?php

namespace CaveResistance\Echo\Server\Database;

use CaveResistance\Echo\Server\Application\Configurations;
use mysqli;

class Database {

    public static function connect() {
        return new mysqli(
            Configurations::get(DATABASE_ACCESS)['hostname'], 
            Configurations::get(DATABASE_ACCESS)['username'], 
            Configurations::get(DATABASE_ACCESS)['password'], 
            Configurations::get(DATABASE_ACCESS)['dbname']
        );
    }
}