<?php

if (!function_exists('get_svg')) {
    function get_svg($path)
    {
        $file_path = public_path($path);
        if (file_exists($file_path)) {
            return file_get_contents($file_path);
        }
        return 'Sorry'; // Return empty string if file doesn't exist
    }
}
