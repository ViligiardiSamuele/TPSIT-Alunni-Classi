<?php

class Alunno implements JsonSerializable
{

    protected $nome;
    protected $cognome;
    protected $eta;

    public function __construct($nome, $cognome, $eta)
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

    public function jsonSerialize()
    {
        return ['nome' => $this->nome, 'cognome' => $this->cognome, 'eta' => $this->eta];
    }
}