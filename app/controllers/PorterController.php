<?php

class PorterController extends Controlador
{

    private $porterModel;
    private $peopleModel;
    private $torreModel;
    private $paquetModel;

    public function __construct()
    {
        $this->porterModel = $this->modelo('PorterModel');
        $this->peopleModel = $this->modelo('PeopleModel');
        $this->torreModel = $this->modelo('TorreModel');
        $this->paquetModel = $this->modelo('PaquetModel');
    }

    public function index($messageError = null, $messageInfo = null)
    {
        $countGuest = $this->peopleModel->getNumberGuest();
        $Torres = $this->torreModel->setTorres();

        // Retorna tanto el mensaje de error como el de éxito (si existen)
        return [
            'messageError' => $messageError,
            'messageInfo' => $messageInfo,
            'total' => $countGuest->total,
            'torre' => $Torres,
        ];
    }


    public function createGuest()
    {
        if (isset($_POST['Visitantes']) && !empty(trim($_POST['u_id'])) && !empty(trim($_POST['U_Nombre'])) && !empty(trim($_POST['U_Apellido'])) && !empty(trim($_POST['U_Motivo'])) && !empty(trim($_POST['select_personas'])) && !empty(trim($_POST['select_id']))) {
            $datos = [
                'Cedula' => trim($_POST['u_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellido' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Departamento' => trim($_POST['select_id']),
                'Motivo' => trim($_POST['U_Motivo']),
                'PeopleId' => trim($_POST['select_personas']),
            ];

            // Llamar al modelo para agregar el visitante
            
            $result = $this->porterModel->addGuest($datos);

            // Verificar el resultado y pasar el mensaje adecuado
            if ($result === false) {
                // Si hay un error, pasar el mensaje de error
                $datos = $this->index('El visitante ' . $_POST['U_Nombre'] . ' ' . $_POST['U_Apellido'] . ', no ha salido', null); // Pasar solo el mensaje de error
            } else {
                // Si todo es correcto, pasar el mensaje de éxito
                $datos = $this->index(null, 'Visitante guardado correctamente'); // Pasar solo el mensaje de éxito
            }

            // Llamamos a la vista con los datos (mensaje de error o éxito)
            $this->vista('pages/porter/porterView', $datos);
        }else{
            $datos = $this->index('Error al momento de ingresar un visitante', null);
            $this->vista('pages/porter/porterView', $datos);
        }
    }



    public function dropGuest()
    {
        $result = $this->peopleModel->getVisitantes($_POST['salida_visita']);
        if ($result) {
            $this->peopleModel->getGuestById($_POST['salida_visita']);
            $datos = $this->index(null, 'Salida registrada exitosamente');
        } else {
            $datos = $this->index("No se encontró el visitante con el id: " . $_POST['salida_visita'], null);
        }

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
            $result = $this->peopleModel->getAllPeople($_POST['select_personas']);
            if ($result == false) {

                $datos = $this->index('Error verifique que sea un residente', null);
            } else {
                $result = $this->porterModel->enterPackage($paquete);
                $datos = $this->index(null, 'Paquete guardado correctamente');
            }

            $this->vista('pages/porter/porterView', $datos);
        }
    }

    public function show()
    {
        return $this->peopleModel->getVisitas();
    }

    public function showPackeges()
    {
        return $this->peopleModel->getPackeges();
    }
    
    public function showRegistro()
    {
        return $this->peopleModel->showRegistro();
    }

    public function getPeopleBypa()
    {
        $id = $_POST['residente'];
        $mostrar = $this->peopleModel->PeopleID($id);
        echo json_encode($mostrar);
    }

    public function getPaquetById()
    {
        $id = $_POST['residente'];
        $paquetes = $this->paquetModel->getPaquetById($id);
        echo json_encode($paquetes);
    }

    public function updatePaquete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $paqueteId = $_POST['paquete_id'];
            $nuevoEstado = $_POST['nuevo_estado'];

            $resultado = $this->paquetModel->actualizarPaquete($paqueteId, $nuevoEstado);

            echo json_encode(['success' => $resultado]);
        }
    }

    public function getTorres()
    {
        $this->torreModel->getTorreByTable();
    }
}
