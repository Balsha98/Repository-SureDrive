<?php

class Debugger
{
    static function debug($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit();
    }

    static function print($data)
    {
        print_r($data);
        exit();
    }
}
