<?php
class UserController extends Controlador
{
    private $AdminModel;
    private $PeopleModel;

    public function __construct()
    {
        $this->AdminModel = $this->modelo('AdminModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
        //echo 'Controlador paginas cargado';
    }

    public function createUser()
    {
        if (isset($_POST["Enviar"])) {
            $datos = [
                'Cedula' => trim($_POST['U_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellidos' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Gmail' => trim($_POST['U_Gmail']),
                'Departamento' => trim($_POST['U_Departamento']),
                'Rol' => trim($_POST['R_id']),
                'Contrasena' => trim($_POST['U_contrasena']),
            ];
            $message = 'Usuario guardado correctamente';
            $this->AdminModel->addUser($datos);

            $datos = [
                'messageInfo' => $message,
            ];
            $this->vista('pages/admin/AdminView', $datos);
        } else {
            echo "error";
        }
    }

    public function mostrarFormulario()
    {
        // Verificar si se recibió el ID del usuario en POST (por input o select)
        if (isset($_POST['id_usuario']) || isset($_POST['buscar'])) {
            $id = $_POST['id_usuario'];
            $this->PeopleModel->getPersonaById($id);
        }

        $this->vista('pages/admin/adminView', null);
    }
}
