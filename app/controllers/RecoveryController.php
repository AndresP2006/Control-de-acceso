<?php

class RecoveryController extends Controlador
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->modelo('UserModel');
        //echo 'Controlador paginas cargado';
    }

    public function index()
    {
        header('location:' . RUTA_URL . '/HomeController/recovery');
    }

    public function recovery(){

        if(!empty($_POST['correo'])){

            
            $datos = $this->userModel->getUserByEmail($_POST['correo']);
        }else{
            $message = "Digite un correo electronico";


            $datos = [
                'messageError' => $message
            ];
    
            $this->vista('pages/recoveryView', $datos);
        }

        

    }

}
