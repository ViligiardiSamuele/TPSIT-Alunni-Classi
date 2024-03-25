<?php

abstract class DBObject implements JsonSerializable
{
    protected $table;
    
    public function __construct() {
        
    }

    function getTable() {
        return $this->table;
    }

    public function jsonSerialize()
    {
        $attr = [];
        foreach (get_class_vars(get_class($this)) as $name => $value) {
            $attr[$name] = $this->{$name};
        }
        return $attr;
    }
}
