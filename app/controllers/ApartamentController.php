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

    public function getPeopleByApartament(){
        $personas = $this->ApartamentModel->getPeopleByApartament($_POST['apartamento_id']);
        echo json_encode($personas);
    }
    
}