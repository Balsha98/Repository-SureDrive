<?php

class Session
{
    public static function start()
    {
        if (PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getSessionVar($key)
    {
        return $_SESSION[$key];
    }

    public static function setSessionVar($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function is_set($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function unsetSessionVars()
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    }

    public static function end()
    {
        if (PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
