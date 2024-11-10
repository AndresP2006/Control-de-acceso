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

        if ($result && isset($result)) {
            if ($result->Us_contrasena === $_POST['password']) {

                $_SESSION['sesion_activa'] = true;
                $_SESSION['datos'] = $result;

                switch ($result->Ro_id) {
                    case "1": // administrador
                
                        header('location:' . RUTA_URL . '/HomeController/admin');
                        break;
                    case "2": // guardia

                        header('location:' . RUTA_URL . '/HomeController/guard');
                        break;
                }
            } else {
                $message = "Contraseña incorrecta";
            }
        } else {
            $message = "Usuario incorrecto";
        }

        $datos = [
            'messageError' => $message
        ];

        $this->vista('pages/homeView', $datos);
    }

    public function verPorter()
    {
        $this->vista('pages/porter/porterView', null);
    }


}
