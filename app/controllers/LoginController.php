<?php

class LoginController extends Controlador
{
    private $userModel;

    public function __construct()
    {
        // Carga el modelo de usuario
        $this->userModel = $this->modelo('UserModel');
    }

    public function index()
    {
        // Busca usuario por email o nombre
        $result = $this->userModel->getUserByEmailOrName($_POST['usuario']);

        if ($result && isset($result)) {
            // Verifica la contraseña
            if ($result->Us_contrasena === $_POST['password']) {
                // Inicia sesión y guarda datos en la sesión
                $_SESSION['sesion_activa'] = true;
                $_SESSION['datos'] = $result;

                // Redirige según el rol del usuario
                switch ($result->Ro_id) {
                    case "1": // administrador
                        header('location:' . RUTA_URL . '/HomeController/admin');
                        break;
                    case "2": // guardia
                        header('location:' . RUTA_URL . '/HomeController/guard');
                        break;
                    case "3": // residente
                        header('location:' . RUTA_URL . '/HomeController/resident', );
                        break;
                }
            } else {
                // Contraseña incorrecta
                $message = "Contraseña incorrecta";
            }
        } else {
            // Usuario no encontrado
            $message = "Usuario incorrecto";
        }

        // Envía mensaje de error a la vista
        $datos = [
            'messageError' => $message
        ];

        $this->vista('pages/homeView', $datos);
    }

    public function verPorter()
    {
        // Muestra la vista del portero
        $this->vista('pages/porter/porterView', null);
    }
}
