<?php

namespace TruMVC\Data;
use TruMVC\Core\Collection;

class Arrays extends Collection
{
    private $arr;
    public function __construct(Array $array)
    {
        $this->arr = $array;
    }    
}
