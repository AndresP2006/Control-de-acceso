<?php

class LoginController extends Controlador
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->modelo('UserModel');
        //echo 'Controlador paginas cargado';
    }

    public function index()
    {
        $result = $this->userModel->getUserByEmailOrName($_POST['usuario']);

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
                    case "3": // residente
                        
                        // header('location:' . RUTA_URL . '/HomeController/notificaciones', );
                        header('location:' . RUTA_URL . '/HomeController/resident', );
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
