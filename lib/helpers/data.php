<?php


if(!function_exists('Str')){
    function Str($string)
    {
        return new Strings($string);
    }
}