<?php

class PorterController extends Controlador
{

    private $PorterModel;
    private $PeopleModel;
    private $TorreModel;
    private $PaquetModel;

    public function __construct()
    {
        $this->PorterModel = $this->modelo('PorterModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
        $this->TorreModel = $this->modelo('TorreModel');
        $this->PaquetModel = $this->modelo('PaquetModel');
    }

    public function index($message = null)
    {
        $countGuest = $this->PeopleModel->getNumberGuest();
        $Torres = $this->TorreModel->setTorres();

        return [
            'messageInfo' => $message,
            'total' => $countGuest->total,
            'torre' => $Torres,
        ];
    }

    public function createGuest()
    {
        if (isset($_POST['Visitantes'])) {
            $datos = [
                'Cedula' => trim($_POST['u_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellido' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Departamento' => trim($_POST['select_id']),
                'Motivo' => trim($_POST['U_Motivo']),
                'PeopleId' => trim($_POST['select_personas']),
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
            $paquete = [
                'estado' => 'Bodega',
                'descripcion' => trim(($_POST['descripcion'])),
                'fecha' => trim($_POST['fecha']),
                'responsable' => trim($_POST['recibidor']),
                'peoplePaq' => trim($_POST['select_personas']),
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

    public function getPaquetById()
    {
        $id = $_POST['residente'];
        $paquetes = $this->PaquetModel->getPaquetById($id);
        echo json_encode($paquetes);
    }

    public function updatePaquete(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paqueteId = $_POST['paquete_id'];
            $nuevoEstado = $_POST['nuevo_estado'];
    
            $resultado = $this->PeopleModel->actualizarPaquete($paqueteId, $nuevoEstado);
    
            echo json_encode(['success' => $resultado]);
        }
    }

}