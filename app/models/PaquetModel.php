<?php

class PaquetModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function getPaquetById($id)
    {
        $this->db->query("SELECT * FROM paquete WHERE pe_id = $id AND Pa_estado != 'Entregado';");
        return $this->db->registros();
    }
    public function deletePaquetById($id)
    {
        $this->db->query("DELETE FROM paquete WHERE Pa_id = :Id");
        $this->db->bind(':Id', $id);
        return $this->db->registros();
    }
}
