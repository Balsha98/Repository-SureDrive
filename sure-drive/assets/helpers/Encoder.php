<?php

class Encoder
{
    static function to_json($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    static function from_json($data)
    {
        return json_decode($data, true);
    }
}
