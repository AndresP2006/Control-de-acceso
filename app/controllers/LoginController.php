<?php

class LoginController extends Controlador
{

    private $UserModel;

    public function __construct()
    {
        $this->UserModel = $this->modelo('UserModel');
        //echo 'Controlador paginas cargado';
    }

    public function index()
    {
        $result = $this->UserModel->getUserByEmailOrName($_POST['usuario']);

        if (isset($result)) {
            if ($result->Us_contrasena === $_POST['password']) {
                switch ($result->Ro_id) {
                    case "1": // administrador
                        $this->vista('pages/admin/adminView', $result);
                        break;
                    case "2": // guardia
                        $this->vista('pages/porter/porterView', $result);
                        break;
                }
            }
        }
        // $this->vista('pages/admin/adminView', null);
    }

    public function verPorter()
    {
        $this->vista('pages/porter/porterView', null);
    }


}
