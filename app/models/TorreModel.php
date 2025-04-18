<?php

class TorreModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function setTorres()
    {
        $this->db->query("SELECT * FROM torre");

        return $this->db->registros();
    }

    public function getTorreByTable()
    {
        $this->db->query("SELECT * FROM torre");
        return $this->db->showTables();
    }

    public function verifyTower($id)
    {
        $this->db->query('SELECT COUNT(*) as count FROM torre WHERE To_id = :id ');
        $this->db->bind(':id', $id);
        $row = $this->db->registro();
        if ($row->count > 0) {
            return true;
        } else {

            return false;
        }
    }

    // funciones de torre 
    public function IngresarTorre($id, $letra)
    {
        if ($this->existTorre($id, $letra)) {
            return false;
        }

        $this->db->query('INSERT INTO torre (To_id, To_letra) VALUES (:id, :letra)');
        $this->db->bind(':id', $id);
        $this->db->bind(':letra', $letra);
        return $this->db->execute() ? true : false;
    }

    private function existTorre($id, $letra = null)
    {
        $this->db->query('SELECT COUNT(*) as count FROM torre WHERE To_id = :id OR To_letra = :letra');
        $this->db->bind(':id', $id);
        $this->db->bind(':letra', $letra);
        $row = $this->db->registro();
        return $row->count > 0;
    }

    private function isTorreInUse($id)
    {
        // Verificar si existen apartamentos asociados a esta torre
        $this->db->query('SELECT COUNT(*) as count FROM apartamento WHERE To_id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->registro(); // Obtiene un objeto stdClass
        return $row->count > 0; // Verificar si hay apartamentos asociados
    }

    public function DeleteTorre($id)
    {
        // Primero verificamos si la torre está en uso
        if ($this->isTorreInUse($id)) {
            return false;
        }

        // Si no está en uso, procedemos a eliminarla
        // Iniciar una transacción
        $this->db->beginTransaction();

        try {
            // Eliminar primero los apartamentos relacionados con la torre
            $this->db->query('DELETE FROM apartamento WHERE To_id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Luego eliminar la torre
            $this->db->query('DELETE FROM torre WHERE To_id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Hacer commit si todo sale bien
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            $this->db->rollBack();
            return "Error al eliminar la torre y los apartamentos: " . $e->getMessage();
        }
    }
}
