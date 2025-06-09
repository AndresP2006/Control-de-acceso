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
        $this->db->query("SELECT * 
                            FROM visitantes v
                            INNER JOIN registro r ON v.Vi_id = r.Vi_id
                            WHERE r.Use_visit = 'VisitaUser' and r.Re_hora_salida= '00:00:00';");
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
