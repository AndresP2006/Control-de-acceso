<?php

class PorterController extends Controlador
{

    private $PorterModel;
    private $PeopleModel;
    private $PaquetModel;

    public function __construct()
    {
        $this->PorterModel = $this->modelo('PorterModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
        $this->PaquetModel = $this->modelo('PaquetModel');
        //echo 'Controlador paginas cargado';
    }

    // public function index()
    // {

    // }

    public function createGuest()
    {
        if (isset($_POST['Visitantes'])) {

            $people = $this->PeopleModel->getPeopleByApart($_POST['U_Departamento']);

            $datos = [
                'Cedula' => trim($_POST['u_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellido' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Departamento' => trim($_POST['U_Departamento']),
                'Motivo' => trim($_POST['U_Motivo']),
                'PeopleId' => trim($people->Pe_id),
            ];
            $message = 'Visitante guardado correctamente';
            $this->PorterModel->addGuest($datos);

            $datos = [
                'messageInfo' => $message
            ];
            $this->vista('pages/porter/porterView', $datos);
        }
    }
    public function enterPackage()
    {
        if (isset($_POST['paquetes'])) {
            $people = $this->PeopleModel->documentPers($_POST['documento']);

            $paquete = [
                'estado' => trim($_POST['estado']),
                'descripcion' => trim(($_POST['descripcion'])),
                'fecha' => trim($_POST['fecha']),
                'responsable' => trim($_POST['recibidor']),
                // 'Documento' => trim($_POST['Documento']),
                'peoplePaq' => trim($people->Pe_id),
            ];
            $message = 'Paquete guardado correctamente';
            $this->PorterModel->enterPackage($paquete);

            $datos = [
                'messageInfo' => $message
            ];
            $this->vista('pages/porter/porterView', $datos);
        }
    }
}
