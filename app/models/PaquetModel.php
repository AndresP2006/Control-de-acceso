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
        $this->db->query("SELECT * FROM paquete WHERE pe_id = $id AND Pa_estado != 'Entregado'");
        return $this->db->registros();
    }

    public function deletePaquetById($id)
    {
        $this->db->query("DELETE FROM paquete WHERE Pa_id = :Id and Pa_estado='Entregado'");
        $this->db->bind(':Id', $id);
        return $this->db->registro();
    }

    public function getPackegesBy($id)
    {
        $this->db->query("SELECT * FROM paquete WHERE Pe_id = :Id AND Pa_estado != 'Entregado'");
        $this->db->bind(':Id', $id);
        return $this->db->registros() ? true : false;
    }

    public function getpaquetesByTable()
    {
        $this->db->query("SELECT 
                            remitente.Pe_nombre AS nombre_remitente,
                            remitente.Pe_apellidos AS apellido_remitente,
                            receptor.Pe_nombre AS nombre_receptor,
                            receptor.Pe_apellidos AS apellido_receptor,
                            p.*
                            FROM paquete p
                            JOIN persona remitente ON p.Pe_id = remitente.Pe_id
                            LEFT JOIN persona receptor ON p.Pa_recibe = receptor.Pe_id;");
        return $this->db->registros();
    }

    public function actualizarPaquete($paqueteId, $nuevoEstado, $paRecibe)
    {
        $sql = "UPDATE paquete 
            SET Pa_estado = :estado,
                Pa_recibe = :recibe,
                Pa_fecha_recibido = NOW()
            WHERE Pa_id = :id";

        $this->db->query($sql);
        $this->db->bind(':estado', $nuevoEstado);
        $this->db->bind(':recibe', $paRecibe);
        $this->db->bind(':id', $paqueteId);

        return $this->db->execute();
    }


    public function getPaquetesPorUsuario($usuario)
    {
        $this->db->query("SELECT Pa_descripcion, Pa_fecha, Pa_estado, Pa_responsable
                          FROM paquete
                          WHERE Pe_id IN (SELECT Pe_id FROM persona WHERE Pe_nombre = :usuario)AND Pa_estado = 'Bodega';");
        $this->db->bind(':usuario', $usuario);
        return $this->db->registros();
    }
    public function getPackagesByDateRange($fechaInicio, $fechaFin)
    {
        // Usamos LEFT JOIN para traer datos aunque no haya coincidencia (opcional).
        // Si quieres solo coincidencias exactas, usa INNER JOIN.
         $this->db->query("SELECT 
                        remitente.Pe_nombre AS nombre_remitente,
                        remitente.Pe_apellidos AS apellido_remitente,
                        receptor.Pe_nombre AS nombre_receptor,
                        receptor.Pe_apellidos AS apellido_receptor,
                        p.*
                     FROM paquete p
                     JOIN persona remitente ON p.Pe_id = remitente.Pe_id
                     LEFT JOIN persona receptor ON p.Pa_recibe = receptor.Pe_id
                     WHERE p.Pa_fecha BETWEEN :inicio AND :fin");

    // Asignamos los valores de las fechas
    $this->db->bind(':inicio', $fechaInicio . ' 00:00:00');
    $this->db->bind(':fin', $fechaFin . ' 23:59:59');

        // Ejecutamos y retornamos los resultados
        return $this->db->registros();
    }

    public function getAllPackages()
    {
        $this->db->query("SELECT 
                        remitente.Pe_nombre AS nombre_remitente,
                        remitente.Pe_apellidos AS apellido_remitente,
                        receptor.Pe_nombre AS nombre_receptor,
                        receptor.Pe_apellidos AS apellido_receptor,
                        p.*
                        FROM paquete p
                        JOIN persona remitente ON p.Pe_id = remitente.Pe_id
                        LEFT JOIN persona receptor ON p.Pa_recibe = receptor.Pe_id");
        return $this->db->registros();
    }
    public function getPacketePeopleId($id)
    {
        $this->db->query("SELECT 
                        remitente.Pe_nombre AS nombre_remitente,
                        remitente.Pe_apellidos AS apellido_remitente,
                        receptor.Pe_nombre AS nombre_receptor,
                        receptor.Pe_apellidos AS apellido_receptor,
                        p.*
                        FROM paquete p
                        JOIN persona remitente ON p.Pe_id = remitente.Pe_id
                        LEFT JOIN persona receptor ON p.Pa_recibe = receptor.Pe_id WHERE  remitente.Pe_id=:id");
        $this->db->bind(':id', $id);
        return $this->db->registros();
    }
}
