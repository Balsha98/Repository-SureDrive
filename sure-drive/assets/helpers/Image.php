<?php

class Image
{
    static function render_image($type, $image)
    {
        if (is_null($image)) {
            $image = file_get_contents(DOMAIN . "/assets/media/{$type}-placeholder.jpeg");
        }

        return base64_encode($image);
    }
}
