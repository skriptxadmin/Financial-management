<?php

if (!function_exists('svg')) {

    function svg($name)
    {

        $path = APPPATH . 'Views/svgs/' . $name . '.svg';

        if (!file_exists($path)) {
            return '';
        }
        
        return file_get_contents($path);
    }

}