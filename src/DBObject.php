<?php

abstract class DBObject implements JsonSerializable
{
    protected $table;

    function getTable()
    {
        return $this->table;
    }

    /**
     * restituisce le variabili dell'oggetto (eccetto table) 
     */
    function getVars()
    {
        $vars = [];
        foreach (get_class_vars(get_class($this)) as $name => $value) {
            if ($name != 'table')
                $vars[] = $name;
        }
        return $vars;
    }

    /**
     * restituisce i valori per ogni colonna
     * se string saranno circondanti dagli apici
     */
    function getValues()
    {
        $values = [];
        foreach (get_class_vars(get_class($this)) as $key => $value) {
            if ($key != 'table') {
                switch (gettype($this->{$key})) {
                    case 'string':
                        $values[] = '\'' . $this->{$key} . '\'';
                        break;
                    default:
                        $values[] = $this->{$key};
                }
            }
        }
        return $values;
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
