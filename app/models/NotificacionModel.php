<?php

class NotificacionModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPendingNotifications()
    {
        try {
            $this->db->query("SELECT * FROM solicitudes_actualizacion WHERE vista = :num");
            $this->db->bind(':num', 0);
            return $this->db->registros();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function markNotificationAsViewed()
    {
        try {
            $sql = "UPDATE solicitudes_actualizacion 
                SET vista = :num";

            $this->db->query($sql);
            $this->db->bind(':num', 1);

            return $this->db->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getNotifiPaquete($id)
    {
        try {
            $this->db->query("SELECT * FROM paquete WHERE vista = :num AND Pe_id=:id");
            $this->db->bind(':num', 0);
            $this->db->bind(':id', $id);
            return $this->db->registros();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function markNotificationPaqued($id)
    {
        try {
            $sql = "UPDATE paquete 
                SET vista = :num WHERE  Pe_id=:id";

            $this->db->query($sql);
            $this->db->bind(':num', 1);
            $this->db->bind(':id', $id);

            return $this->db->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getNotifiRegistro($id)
    {
        try {
            $this->db->query("SELECT * FROM registro WHERE vista = :num AND Pe_id=:id");
            $this->db->bind(':num', 0);
            $this->db->bind(':id', $id);
            return $this->db->registros();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function markNotificationRegistro($id)
    {
        try {
            $sql = "UPDATE registro 
                SET vista = :num WHERE  Pe_id=:id";

            $this->db->query($sql);
            $this->db->bind(':num', 1);
            $this->db->bind(':id', $id);

            return $this->db->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getNotifiRechazo($id)
    {
        try {
            $this->db->query("SELECT * FROM solicitudes_actualizacion WHERE vista_resident = :num AND id_residente=:id AND estado=:estado");
            $this->db->bind(':num', 0);
            $this->db->bind(':id', $id);
            $this->db->bind(':estado', 'rechazada');
            return $this->db->registros();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function markNotificationRechazo($id)
    {
        try {
            $sql = "UPDATE solicitudes_actualizacion 
                SET vista_resident = :num WHERE  id_residente=:id";

            $this->db->query($sql);
            $this->db->bind(':num', 1);
            $this->db->bind(':id', $id);

            return $this->db->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
