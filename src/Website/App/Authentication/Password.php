<?php

namespace CaveResistance\Echo\Website\App\Authentication;

class Password {

    private static array $pepper = [
        'fxr^34AsmT',
        'Mz%S%3Qazm',
        'F%3Mc9GeNh'
    ];

    public static function hash(string $password): string
    {
        return hash('sha256', trim($password));
    }

    public static function season($password ,&$salt, &$pepperID): string
    {
        $pepperID = rand(0,2);
        $pepper = static::$pepper[$pepperID];
        $salt = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
        return $pepper.$password.$salt;
    }

    public static function verify(string $passToVerify, string $correctHashedPassword, string $salt, int $pepperID): bool
    {
        return $correctHashedPassword === static::hash(static::$pepper[$pepperID].$passToVerify.$salt);
    }
}