<?php

class TorreModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function setTorres()
    {
        $this->db->query("SELECT * FROM torre");

        return $this->db->registros();
    }

}