<?php

class Notificaciones extends Controlador{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->modelo('UserModel');
        //echo 'Controlador paginas cargado';
    }

    
}