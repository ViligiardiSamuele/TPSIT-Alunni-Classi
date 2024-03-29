<?php

class Alunno extends DBObject
{

    protected string $nome;
    protected string $cognome;
    protected int $eta;
    protected $table = 'Alunni';

    public function __construct(string $nome, string $cognome, int $eta)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->eta = $eta;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getCognome()
    {
        return $this->cognome;
    }

    public function getEta()
    {
        return $this->eta;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    public function setEta($eta)
    {
        $this->eta = $eta;
    }
}
