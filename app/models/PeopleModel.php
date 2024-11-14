<?php

class PeopleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPeopleByApart($numberApart)
    {
        $this->db->query("SELECT Pe_id FROM persona p  WHERE  p.Ap_id = $numberApart");

        return $this->db->registro();
    }
    public function documentPers($document)
    {
        $this->db->query("SELECT Pe_id FROM persona p  WHERE  p.Pe_id = $document");

        return $this->db->registro();
    }

    public function getNumberGuest()
    {

        $this->db->query("SELECT count(*)as countGuest from visitantes");

        return $this->db->registro();
    }

    public function getAllPeople()
    {
    
        $this->db->query("SELECT * FROM persona");

        
        return $this->db->registros();
    }
}
