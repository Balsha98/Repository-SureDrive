<?php

class Image
{
    public static function renderImage($type, $image)
    {
        if ($image === null) {
            $image = file_get_contents(SERVER . "/assets/media/{$type}-placeholder.jpeg");
        }

        return base64_encode($image);
    }
}
