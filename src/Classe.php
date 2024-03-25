<?php

class Classe extends DBObject 
{

    protected $array = [];
    protected $nome;

    public function __construct()
    {
        $this->nome = "5B";
        $a1 = new Alunno("aaa", "bbb", 25);
        $a2 = new Alunno("adg", "ryuwe5y", 343);
        $a3 = new Alunno("sdfhsfh", "fjj", 275);
        array_push($this->array, $a1);
        array_push($this->array, $a2);
        array_push($this->array, $a3);
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getArray()
    {
        return $this->array;
    }

    public function getAlunno($cognome, $nome, $json)
    {
        foreach ($this->array as $a) {
            if ($a->getNome() == $nome && $a->getCognome() == $cognome) {
                if ($json)
                    return $a->jsonSerialize();
                else
                    return $a;
            }
        }
        return;
    }

    public function getAlunnoByID($id)
    {
        if (isset($this->array[$id])) {
            return $this->array[$id];
        }
        return;
    }

    public function rmAlunnoByID($id)
    {
        if (isset($this->array[$id])) {
            unset($this->array[$id]);
            return true;
        }
        return false;
    }
}
