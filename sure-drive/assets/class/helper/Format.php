<?php

class Format
{
    public static function formatNumber($price, $decimals)
    {
        return number_format($price, $decimals, '.', ',');
    }
}
