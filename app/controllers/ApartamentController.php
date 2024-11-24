<?php

class ApartamentController extends Controlador
{
    private $ApartamentModel;

    public function __construct()
    {
        $this->ApartamentModel = $this->modelo('ApartamentModel');
    }
    
    public function getApartamentByTower()
    {
        $respuesta =  $this->ApartamentModel->getApartamentByTower($_POST['TowerId']);
        echo json_encode($respuesta);
    
    }
}