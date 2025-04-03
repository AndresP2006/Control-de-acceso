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
        $this->db->query("SELECT DISTINCT *  FROM visitantes");
        return $this->db->showTables();
    }
    public function obtenerVisitantesPorFecha($fecha)
    {
        $sql = "SELECT v.* 
                FROM visitantes v
                JOIN registro r ON v.Vi_id = r.Vi_id
                WHERE r.Re_fecha_entrada = :fecha";
        $this->db->query($sql);
        $this->db->bind(':fecha', $fecha);
        return $this->db->registros();
    }
}
