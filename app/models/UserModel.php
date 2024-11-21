<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getUserByEmailOrName($emailOrName)
    {
        $this->db->query("select * from usuario u where u.Us_usuario='$emailOrName' or u.Us_correo='$emailOrName'");

        return $this->db->registro();
    }
}
