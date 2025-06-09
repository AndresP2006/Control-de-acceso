<?php

class PorterModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function addGuest($datos)
    {
        // Comprobar si el visitante ya existe
        $this->db->query('SELECT COUNT(*) as count FROM visitantes WHERE Vi_id = :Cedula');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->execute();
        $result = $this->db->single();
        $visitorExists = $result['count'] > 0;

        // Si el visitante existe, verificar si tiene un registro activo (sin hora de salida)
        if ($visitorExists) {
            $this->db->query('
            SELECT COUNT(*) as count 
            FROM registro 
            WHERE Vi_id = :Cedula AND Re_hora_salida = "00:00:00"
        ');
            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->execute();
            $activeRecordCount = $this->db->single()['count'];

            if ($activeRecordCount > 0) {
                // Si ya tiene un registro activo, no se permite crear uno nuevo
                return false; // Ya existe un registro sin hora de salida
            }
        } else {
            // Si no existe el visitante, se inserta en la tabla "visitantes"
            $this->db->query('
            INSERT INTO visitantes (Vi_id, Vi_nombres, Vi_apellidos, Vi_telefono) 
            VALUES (:Cedula, :Nombre, :Apellido, :Telefono)
        ');

            $this->db->bind(':Cedula', $datos['Cedula']);
            $this->db->bind(':Nombre', $datos['Nombre']);
            $this->db->bind(':Apellido', $datos['Apellido']);
            $this->db->bind(':Telefono', $datos['Telefono']);

            if (!$this->db->execute()) {
                // Si falla la inserción en la tabla "visitantes", terminar
                return false;
            }
        }

        // Crear un nuevo registro en la tabla "registro" para el visitante
        $this->db->query('
        INSERT INTO registro (Re_fecha_entrada, Re_hora_entrada, Re_motivo,Vi_departamento,Pe_id, Vi_id) 
        VALUES (CURRENT_DATE, CURRENT_TIME, :Motivo,:Departamento,:PeopleId, :Cedula)
    ');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Motivo', $datos['Motivo']);
        $this->db->bind(':Departamento', $datos['Departamento']);
        $this->db->bind(':PeopleId', $datos['PeopleId']);

        return $this->db->execute();
    }

    

    public function enterPackage($paquete)
    {
        $this->db->query('INSERT INTO paquete (Pa_estado, Pa_descripcion, Pa_fecha, Pa_responsable, Pe_id)VALUES
        (:estado, :descripcion, :fecha, :recibidor, :peoplePaq)');
        $this->db->bind(':estado', $paquete['estado']);
        $this->db->bind(':descripcion', $paquete['descripcion']);
        $this->db->bind(':fecha', $paquete['fecha']);
        $this->db->bind(':recibidor', $paquete['responsable']);
        $this->db->bind(':peoplePaq', $paquete['peoplePaq']);
        ($this->db->execute()) ? true : false;
    }

    public function leavePackage($paquete) {}

    public function verificarVisitante($cedula)
    {
        $this->db->query("SELECT * FROM registro r, visitantes v WHERE v.Vi_id = :cedula AND (r.Use_visit = 'solicitar' OR r.Re_hora_salida = '00:00:00')");
        $this->db->bind(':cedula', $cedula);
        return $this->db->registro(); // o fetch(), dependiendo de tu clase DB
    }

    public function IngresarVisit($datos){
        $this->db->query("INSERT INTO visitantes (Vi_id, Vi_nombres, Vi_apellidos, Vi_telefono, estado) VALUES (:cedula, :nombre, :apellido, :telefono, 0)");

        $this->db->bind(":cedula", $datos['cedula']);
        $this->db->bind(":nombre", $datos['nombre']);
        $this->db->bind(":apellido", $datos['apellido']);
        $this->db->bind(":telefono", $datos['telefono']);

        return $this->db->execute();
    }
    public function IngresarRegistro($datos){
        $this->db->query("INSERT INTO registro (Re_fecha_entrada, Re_hora_entrada, Re_hora_salida, Re_motivo, Use_visit, Vi_departamento, Pe_id, Vi_id)
                  VALUES (CURRENT_DATE, '00:00:00', '00:00:00', :motivo, 'solicitar', :departamento, :idResidente, :cedula)");

        $this->db->bind(":motivo", $datos['motivo']);
        $this->db->bind(":departamento", $datos['departamento']);
        $this->db->bind(":idResidente", $datos['idResidente']);
        $this->db->bind(":cedula", $datos['cedula']);

        return $this->db->execute();
    }

    public function VerificarEnt($datos){
        $this->db->query("SELECT * FROM registro WHERE Vi_id = :cedula AND (Use_visit = 'solicitar' OR Re_hora_salida = '00:00:00')");
        $this->db->bind(":cedula", $datos['cedula']);
        return $this->db->registro(); // o fetch(), según tu clase DB
    }

    public function VirificamosRegistro($datos){
        $this->db->query("SELECT * from visitantes where Vi_id =:cedula;");
        $this->db->bind(":cedula", $datos['cedula']);
        return $this->db->registro();
    }
    
}



