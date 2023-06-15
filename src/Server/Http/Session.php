<?php

namespace CaveResistance\Echo\Server\Http;

class Session {

    public static function start(): void
    {
        if(!static::isActive()) {
            $session_name = 'cave_session_id'; // Imposta un nome di sessione
            $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
            $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
            ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
            $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
            session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
            session_start(); // Avvia la sessione php.
            session_regenerate_id();
        }
    }

    public static function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public static function getId(): string
    {
        static::start();
        return session_id();
    }

    public static function hasVariable(string $name): bool
    {
        static::start();
        return isset($_SESSION[$name]);
    }

    public static function setVariable(string $name, mixed $value): void
    {
        static::start();
        $_SESSION[$name] = $value;
    }

    public static function getVariable(string $name): mixed
    {
        static::start();
        return $_SESSION[$name];
    }

    public static function unsetVariable(string $name): void
    {
        static::start();
        if(isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

}