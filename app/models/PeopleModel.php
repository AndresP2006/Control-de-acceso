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

        $this->db->query("SELECT count(*) as total FROM registro WHERE Re_hora_salida = '00:00:00';");

        return $this->db->registro();
    }
    public function getGuestById($idGuest)
    {
        $this->db->query("UPDATE registro SET Re_hora_salida = CURRENT_TIME() WHERE Vi_id ='$idGuest'");

        return $this->db->registro();
    }

    // public function getAllpeople()
    // {
    //     $this->db->query("SELECT * FROM persona");

    //     return $this->db->registros();
    // }
    public function getVisitas()
    {
        $this->db->query("SELECT v.*,h.Re_fecha_entrada,h.Re_hora_entrada,h.Re_hora_salida FROM visitantes v , registro h where v.Vi_id=h.Vi_id");
        return $this->db->showTables();
    }
        

    public function getPersonaById($id)
    {
        $this->db->query('SELECT persona.*, usuario.Ro_id, usuario.Us_correo,r.Ro_tipo 
            FROM persona JOIN usuario ON persona.Pe_id = usuario.Us_id JOIN rol r ON usuario.Ro_id = r.Ro_id  WHERE Pe_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->registro(); // Devuelve un solo registro
    }

    // public function getAllpeople()
    // {
    //     // Realizar la consulta para obtener todos los registros de la tabla 'persona'
    //     $this->db->query("SELECT * FROM persona");

    //     // Comprobar si la consulta devuelve datos
    //     if ($this->db->totalRegistros() > 0) {
    //         return $this->db->registros(); // Esto debería devolver un array de datos
    //     } else {
    //         return []; // Si no hay registros, devolver un array vacío
    //     }
    // }

    public function PeopleID($id)
    {
        $this->db->query(
            "SELECT p.*, COUNT(a.Pa_Id)AS Total_paquetes ,a.Pa_estado,a.Pa_fecha,a.Pa_descripcion  FROM persona p LEFT JOIN paquete a ON p.Pe_id = a.Pe_id WHERE p.Pe_id = $id GROUP BY p.Pe_id;"
        );
        return $this->db->registro();
    }
    public function showRegistro()
    {
        $this->db->query("SELECT v.Vi_nombres,r.*,v.Vi_departamento from visitantes v , registro r where v.Vi_id=r.Vi_id");
        return $this->db->showTables();
    }

    //No tocar este metodo
    public function getAllUsuario($roleId = null)
    {
        if ($roleId) {
            // Consulta con filtro por Rol
            $this->db->query('
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo,r.Ro_tipo 
            FROM persona JOIN usuario ON persona.Pe_id = usuario.Us_id JOIN rol r ON usuario.Ro_id = r.Ro_id 
            WHERE usuario.Ro_id = :roleId
        ');
            $this->db->bind(':roleId', $roleId);
        } else {
            // Consulta sin filtro
            $this->db->query('
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo,r.Ro_tipo 
            FROM persona JOIN usuario ON persona.Pe_id = usuario.Us_id JOIN rol r ON usuario.Ro_id = r.Ro_id 
        ');
        }

        return $this->db->registros(); // Devuelve todos los registros
    }
   
}
