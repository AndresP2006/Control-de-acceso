<?php

class PorterController extends Controlador
{

    private $PorterModel;
    private $PeopleModel;

    public function __construct()
    {
        $this->PorterModel = $this->modelo('PorterModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
    }

    public function index($message = null)
    {
        $countGuest = $this->PeopleModel->getNumberGuest();

        return [
            'messageInfo' => $message,
            'total' => $countGuest->total,
        ];
    }

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
            $this->PorterModel->addGuest($datos);

            $datos = $this->index('Visitante guardado correctamente');
            $this->vista('pages/porter/porterView', $datos);
        }
    }

    public function dropGuest()
    {

        $this->PeopleModel->getGuestById($_POST['salida_visita']);

        $datos = $this->index('Salida registrada exitosamente');
        $this->vista('pages/porter/porterView', $datos);
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
                'peoplePaq' => trim($people->Pe_id),
            ];
            $this->PorterModel->enterPackage($paquete);

            $datos = $this->index('Paquete guardado correctamente');
            $this->vista('pages/porter/porterView', $datos);
        }
    }
    public function show()
    {
        return $this->PeopleModel->getVisitas();
    }
    public function showPackeges()
    {
        return $this->PeopleModel->getPackeges();
    }
    public function showRegistro()
    {
        return $this->PeopleModel->showRegistro();
    }

    public function getPeopleBypa()
    {
        $id = $_POST['residente'];
        $mostrar = $this->PeopleModel->PeopleID($id);
        echo json_encode($mostrar);
        
    }
}
