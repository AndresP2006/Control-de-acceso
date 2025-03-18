<?php

class ApartamentController extends Controlador
{
    private $apartamentModel;

    public function __construct()
    {
        $this->apartamentModel = $this->modelo('ApartamentModel');
    }
    
    public function getApartamentByTower()
    {
        $respuesta =  $this->apartamentModel->getApartamentByTower($_POST['TowerId']);
        echo json_encode($respuesta);
    
    }

    public function getPeopleByApartament(){
        $personas = $this->apartamentModel->getPeopleByApartament($_POST['apartamento_id']);
        echo json_encode($personas);
    }
    
}