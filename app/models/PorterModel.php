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
        $this->db->query('INSERT INTO visitantes (Vi_id, Vi_nombres, Vi_apellidos, Vi_telefono, Vi_departamento, Vi_motivo, Pe_id) VALUES(
        :Cedula, :Nombre, :Apellido, :Telefono, :Departamento, :Motivo, :PeopleId)');
        $this->db->bind(':Cedula', $datos['Cedula']);
        $this->db->bind(':Nombre', $datos['Nombre']);
        $this->db->bind(':Apellido', $datos['Apellido']);
        $this->db->bind(':Telefono', $datos['Telefono']);
        $this->db->bind(':Departamento', $datos['Departamento']);
        $this->db->bind(':Motivo', $datos['Motivo']);
        $this->db->bind(':PeopleId', $datos['PeopleId']);
        ($this->db->execute()) ? true : false;
    }
    public function enterPackage($paquete)
    {
        $this->db->query('INSERT INTO paquete (Pa_estado, Pa_descripcion, Pa_fecha, Pa_responsable, Pe_id)VALUES
        (:estado, :descripcion, :fecha, :recibidor, :peoplePaq)');
        $this->db->bind(':estado', $paquete['estado']);
        $this->db->bind(':descripcion', $paquete['descripcion']);
        $this->db->bind(':fecha', $paquete['fecha']);
        $this->db->bind(':recibidor', $paquete['responsable']);
        // $this->db->bind(':documento', $paquete['Documento']);
        $this->db->bind(':peoplePaq', $paquete['peoplePaq']);
        ($this->db->execute()) ? true : false;
    }
}
