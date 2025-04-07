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

    public function updatePassword($newpass,$correo)
    {
        $this->db->query("UPDATE usuario SET Us_contrasena = '$newpass' WHERE Us_correo = '$correo';");

        return $this->db->registro();
    }
}
