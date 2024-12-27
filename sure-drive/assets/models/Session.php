<?php

class Session
{
    static function start_session()
    {
        if (PHP_SESSION_NONE) {
            session_start();
        }
    }

    static function get_session_var($key)
    {
        return $_SESSION[$key];
    }

    static function set_session_var($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    static function is_set($key)
    {
        return isset($_SESSION[$key]);
    }

    static function unset_session_vars()
    {
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    }

    static function end_session()
    {
        if (PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
