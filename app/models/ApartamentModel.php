<?php

class ApartamentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getApartamentByTower($TowerId)
    {
        $this->db->query("SELECT * FROM apartamento a WHERE a.To_id = $TowerId");

        return $this->db->registros();
    }

    public function getPeopleByApartament($apartamento_id)
    {
        $this->db->query("SELECT * FROM persona p WHERE p.Ap_id = $apartamento_id");

        return $this->db->registros();
    }

    public function getApartamentByTable()
    {
        $this->db->query("SELECT t.* , a.Ap_numero from torre t,apartamento a where a.To_id=t.To_id;");
        return $this->db->showTables();
    }


    private function existsApartamento($torreId, $apartamento)
    {
        $this->db->query('SELECT COUNT(*) as count FROM apartamento WHERE To_id = :torreId AND Ap_numero = :apartamento');
        $this->db->bind(':torreId', $torreId);
        $this->db->bind(':apartamento', $apartamento);
        $row = $this->db->registro();
        return $row->count > 0;
    }

    public function DeleteApartamento($torre, $apartamento)
    {
        $this->db->query('DELETE FROM apartamento 
                            WHERE To_id = (
                                SELECT t.To_id 
                                FROM torre t 
                                WHERE t.To_letra = :torre
                            ) 
                            AND Ap_numero = :apartemento;');
        $this->db->bind(':torre', $torre);
        $this->db->bind(":apartemento", $apartamento);
        // $this->db->bind(':apartamento', $apartamento);
        return $this->db->registro();
    }

    public function peopleApartamento($torre, $apartamento)
    {
        $this->db->query('SELECT p.Pe_nombre,a.Ap_numero,t.To_letra 
                            from persona p  join apartamento a on  p.Ap_id = a.Ap_id
                            join torre t on a.To_id=t.To_id where t.To_letra=:torre and a.Ap_numero=:apartamento');

        $this->db->bind(':torre', $torre);
        $this->db->bind(':apartamento', $apartamento);

        return $this->db->registro();
    }
    // funciones de apartamento
    public function IngresarApartamento($torreInput, $apartamento)
    {
        $torreId = $this->getTorreByIdOrLetra($torreInput);

        if (!$torreId) {
            return "Torre no encontrada. Verifique el número o letra de la torre.";
        }

        if ($this->existsApartamento($torreId, $apartamento)) {
            return "El apartamento ya existe en la torre indicada.";
        }

        $this->db->query('INSERT INTO apartamento (To_id, Ap_numero) VALUES (:torreId, :apartamento)');
        $this->db->bind(':torreId', $torreId);
        $this->db->bind(':apartamento', $apartamento);
        return $this->db->execute() ? "Apartamento guardado correctamente." : "Error al guardar el apartamento.";
    }


    private function getTorreByIdOrLetra($torre)
    {
        $this->db->query('SELECT To_id FROM torre WHERE To_id = :torre OR To_letra = :torre');
        $this->db->bind(':torre', $torre);
        $row = $this->db->registro();
        return $row ? $row->To_id : null;
    }
}
