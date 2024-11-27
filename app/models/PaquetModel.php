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

    public function DeleteTorre($id){
        $this->db->query("DELETE FROM torre WHERE To_id= :Id");
        $this->db->bind(':Id', $id);
        return $this->db->registro();
    }
    public function DeleteApartamento($id){
        $this->db->query("DELETE FROM apartamento WHERE To_id= :Id");
        $this->db->bind(':Id', $id);
        return $this->db->registro();
    }
}
