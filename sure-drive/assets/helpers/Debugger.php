<?php

class Debugger
{
    public static function debug($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit();
    }

    public static function print($data)
    {
        print_r($data);
        exit();
    }
}
