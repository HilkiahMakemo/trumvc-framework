<?php

class Strings
{
    private $string, $length;

    public function __construct($string)
    {
        $this->string = $string;
        $this->length = strlen($this->string);
        return $this;
    }

    public function startsWith($needle)
    {
        return (substr($this->string, 0, strlen($needle)) === $needle);
    }

    public function endsWith($needle)
    {
        return (substr($this->string, - strlen($needle)) === $needle);
    }

    public function contains($needle, $case_sensitive = false)
    {
        $function = $case_sensitive? 'strpos': 'stripos';
        return ($function($this->string, $needle) !== false);
    }

    public function toJson()
    {

    }

    public function toArray()
    {
        
    }
}