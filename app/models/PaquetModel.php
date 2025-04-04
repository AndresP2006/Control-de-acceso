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

    public function getPackegesBy($id)
    {
        $this->db->query("SELECT * FROM paquete WHERE Pe_id = :Id");
        $this->db->bind(':Id', $id);
        return $this->db->registros() ? true : false;
    }
    public function getPackegesByTable()
    {
        $this->db->query("select a.Pe_id,a.Pe_nombre,p.* from paquete p , persona a where a.Pe_id=p.Pe_id;");
        return $this->db->showTables();
    }

    public function actualizarPaquete($paqueteId, $nuevoEstado)
    {
        $sql = "UPDATE paquete SET Pa_estado = :estado WHERE Pa_id = :id";
        $this->db->query($sql);
        $this->db->bind(':estado', $nuevoEstado);
        $this->db->bind(':id', $paqueteId);

        return $this->db->execute();
    }

    public function getPaquetesPorUsuario($usuario)
    {
        $this->db->query("SELECT Pa_descripcion, Pa_fecha, Pa_estado, Pa_responsable
                          FROM paquete
                          WHERE Pe_id IN (SELECT Pe_id FROM persona WHERE Pe_nombre = :usuario)
                          AND Pa_estado = 'Bodega';");
        $this->db->bind(':usuario', $usuario);
        return $this->db->registros();
    }
}
