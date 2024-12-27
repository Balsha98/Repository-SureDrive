<?php

class Format
{
    static function format_number($price, $decimals)
    {
        return number_format($price, $decimals, '.', ',');
    }
}
