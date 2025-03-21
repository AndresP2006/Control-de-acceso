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

    public function getVisitantes($id)
    {
        $this->db->query("SELECT * FROM registro WHERE Vi_id ='$id' AND Re_hora_salida = '00:00:00'");
        return $this->db->registro();
    }



    public function getPersonaById($id)
    {
        $this->db->query('SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra,t.To_id FROM persona LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id LEFT JOIN torre t ON a.To_id = t.To_id   WHERE Pe_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->registro(); // Devuelve un solo registro
    }

    public function getAllRegistro($id)
    {
        $this->db->query("SELECT * FROM registro WHERE Vi_id = :id");
        $this->db->bind(':id', $id); // Usa parámetros para evitar inyección SQL
        $result = $this->db->registros(); // Asegúrate de usar 'registros()' para obtener múltiples resultados

        return $result ?: false; // Devuelve false si no hay resultados
    }

    public function getAllPeople($id)
    {
        $this->db->query("SELECT * FROM persona p JOIN usuario u ON p.Us_id = u.Us_id  WHERE u.Ro_id = 3 AND p.Pe_id  = $id");
        $result = $this->db->registros();
        return $result ? true : false;
    }

    public function getAllpersonas($id)
    {
        $this->db->query("SELECT * FROM persona p JOIN usuario u ON p.Us_id = u.Us_id  WHERE p.Pe_id  = $id");
        $result = $this->db->registros();
        return $result ? true : false;
    }

    public function PeopleID($id)
    {
        $this->db->query("SELECT p.Pe_id,
                            p.Pe_nombre,
                            p.Pe_telefono,
                            p.Pe_apellidos,
                            COUNT(a.Pa_id) AS Total_paquetes,
                            MAX(a.Pa_estado) AS Pa_estado,
                            MAX(a.Pa_fecha) AS Pa_fecha,
                            MAX(a.Pa_descripcion) AS Pa_descripcion,
                            ap.Ap_numero AS Apartamento,
                            t.To_letra AS Torre FROM persona p  
                            LEFT JOIN paquete a ON p.Pe_id = a.Pe_id AND a.Pa_estado != 'Entregado'
                            LEFT JOIN apartamento ap ON p.Ap_id = ap.Ap_id 
                            LEFT JOIN torre t ON ap.To_id = t.To_id WHERE p.Pe_id = $id GROUP BY p.Pe_id, p.Pe_nombre, p.Pe_apellidos, ap.Ap_numero, t.To_letra;");

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
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra, t.To_id 
            FROM persona 
            LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id 
            LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id 
            LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id 
            LEFT JOIN torre t ON a.To_id = t.To_id 
            WHERE usuario.Ro_id = :roleId
        ');
            $this->db->bind(':roleId', $roleId);
        } else {
            // Consulta sin filtro por Rol
            $this->db->query('
            SELECT persona.*, usuario.Ro_id, usuario.Us_correo, r.Ro_tipo, usuario.Us_contrasena, a.Ap_numero, t.To_letra, t.To_id 
            FROM persona 
            LEFT JOIN usuario ON persona.Pe_id = usuario.Us_id 
            LEFT JOIN rol r ON usuario.Ro_id = r.Ro_id 
            LEFT JOIN apartamento a ON persona.Ap_id = a.Ap_id 
            LEFT JOIN torre t ON a.To_id = t.To_id
        ');
        }

        return $this->db->registros(); // Devuelve todos los registros
    }

    public function getAllResident($result)

    {

        $this->db->query("SELECT
                                u.Us_id,
                                p.Pe_nombre,
                                p.Pe_apellidos,
                                u.Us_correo,
                                p.Pe_telefono,
                                t.To_letra,
                                a.Ap_numero
                                FROM persona p
                                INNER JOIN usuario u ON p.Us_id = u.Us_id
                                INNER JOIN apartamento a ON p.Ap_id = a.Ap_id
                                INNER JOIN torre t ON a.To_id = t.To_id
                                WHERE u.Us_usuario = '$result'");

        return $this->db->registros();
    }
    public function getAllRedident($result)
    {

         $this->db->query("SELECT p2.Pe_nombre, p2.Pe_apellidos 
                           FROM persona p1 
                           JOIN apartamento a ON p1.Ap_id = a.Ap_id 
                           JOIN persona p2 ON a.Ap_id = p2.Ap_id 
                           WHERE p1.Pe_nombre = '$result' AND p2.Pe_id <> p1.Pe_id", );

        return $this->db->registros();
    }
}
