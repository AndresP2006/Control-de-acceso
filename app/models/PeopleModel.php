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

    public function getGuestById($idGuest)
    {
        $this->db->query("delete from visitantes  where Vi_id = '$idGuest'");

        return $this->db->registro();
    }
    public function getAllpeople()
    {
        $this->db->query("SELECT * FROM persona");

        return $this->db->registros();
    }
    public function getVisitas()
    {
        $this->db->query("SELECT * FROM visitantes");
        return $this->db->showTables();
    }
    public function getPackeges()
    {
        $this->db->query("SELECT * FROM paquete");
        return $this->db->showTables();
    }

    public function getPersonaById($id)
    {
        // Query que trae los datos de la persona junto con el rol desde la tabla usuario
        $this->db->query("
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo 
            FROM persona 
            LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id 
            WHERE persona.Pe_id = :id
        ");

        // Vinculamos el parámetro
        $this->db->bind(':id', $id);

        // Ejecutamos la consulta y obtenemos el resultado
        return $this->db->registro();
    }

    public function PeopleID($id)
    {
        $this->db->query(
            "SELECT p.*, COUNT(a.Pa_Id) AS Total_paquetes FROM persona p LEFT JOIN paquete a ON p.Pe_id = a.Pe_id WHERE p.Pe_id = $id GROUP BY p.Pe_id;"
        );
        return $this->db->registro();
    }
}
