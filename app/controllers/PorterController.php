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
            $people = $this->PeopleModel->getPeopleByApart($_POST['select_personas']);
            $datos = [
                'Cedula' => trim($_POST['u_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellido' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Departamento' => trim($_POST['select_id']),
                'Motivo' => trim($_POST['U_Motivo']),
                'PeopleId' => trim($people->Pe_id),
            ];
            $this->PorterModel->addGuest($datos);

            $datos = $this->index('Visitante guardado correctamente');
            $this->vista('pages/porter/porterView', $datos);
        }
    }

//     public function searchGuest()
// {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         $cedula = $_POST['u_id'];

//         // Busca al visitante en la base de datos
//         $visitante = $this->PorterModel->searchVisitor($cedula);

//         if ($visitante) {
//             echo json_encode(['success' => true, 'visitante' => $visitante]);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'No se encontró el visitante.']);
//         }
//     } else {
//         // Redirigir si no es una solicitud POST
//         $this->vista('pages/porter/porterView', null);
//     }
// }


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
                'estado' => 'Bodega',
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

    public function getPaquetById()
    {
        $id = $_POST['residente'];
        $paquetes = $this->PaquetModel->getPaquetById($id);
        echo json_encode($paquetes);
    }

}