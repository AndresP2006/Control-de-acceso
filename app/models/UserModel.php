<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function index() {}

    public function getUserByEmailOrName($emailOrName)
    {
        $this->db->query("select * from usuario u where u.Us_usuario='$emailOrName' or u.Us_correo='$emailOrName'");

        return $this->db->registro();
    }

    public function getUserByEmail($email)
    {

        $this->db->query("select * from usuario u where u.Us_correo='$email'");
        return $this->db->registro();
    }

    public function updatePassword($newpass, $correo)
    {
        $this->db->query("UPDATE usuario SET Us_contrasena = '$newpass' WHERE Us_correo = '$correo';");

        return $this->db->registro();
    }

    public function getUserByRol($ValueRol)
    {
        $this->db->query("SELECT u.* FROM usuario u INNER JOIN rol r ON u.Ro_id = r.Ro_id WHERE r.Ro_id = :rol_id");
        $this->db->bind(':rol_id', (int) $ValueRol);
        return $this->db->registros();
    }
}
