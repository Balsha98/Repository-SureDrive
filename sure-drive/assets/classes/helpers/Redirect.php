<?php

class Redirect
{
    public static function redirectTo($page)
    {
        header("location:$page");
    }
}
