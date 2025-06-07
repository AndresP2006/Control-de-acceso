<?php

class VisitorModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getVisitrosByTable()
    {
        $this->db->query("SELECT * FROM visitantes");
        return array_map(function ($registro) {
            return (array) $registro;
        }, $this->db->registros());
    }

    public function getVisitors()
    {
        $hoy = date("Y-m-d");
        $this->db->query("SELECT 
                                v.Vi_id,
                                v.Vi_nombres,
                                v.Vi_apellidos,
                                v.Vi_telefono,
                                r.Re_fecha_entrada,
                                r.Re_hora_entrada,
                                r.Re_hora_salida,
                                r.Re_motivo,
                                a.Ap_numero,
                                t.To_letra,
                                p.Pe_id
                            FROM visitantes v
                            INNER JOIN registro r ON v.Vi_id = r.Vi_id
                            INNER JOIN persona p ON r.Pe_id = p.Pe_id
                            INNER JOIN apartamento a ON p.Ap_id = a.Ap_id
                            INNER JOIN torre t ON a.To_id = t.To_id
                            WHERE r.Use_visit = 'VisitaUser' OR r.Use_visit='Permitido'
                            AND r.Re_fecha_entrada= :fecha");
        $this->db->bind(':fecha',$hoy);
        return array_map(function ($registro) {
            return (array) $registro;
        }, $this->db->registros());
    }
    public function obtenerVisitantesPorFecha($fecha)
    {
        $sql = "SELECT v.* 
                FROM visitantes v
                JOIN registro r ON v.Vi_id = r.Vi_id
                WHERE r.Re_fecha_entrada = :fecha";
        $this->db->query($sql);
        $this->db->bind(':fecha', $fecha);

        // Convertir los resultados a arrays asociativos
        return array_map(function ($registro) {
            return (array) $registro;
        }, $this->db->registros());
    }
}
