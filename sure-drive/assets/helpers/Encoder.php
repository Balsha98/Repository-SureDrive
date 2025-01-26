<?php

class Encoder
{
    public static function toJSON($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public static function fromJSON($data)
    {
        return json_decode($data, true);
    }
}
