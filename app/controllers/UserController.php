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
        // Obtener los datos del modelo
        $registros = $this->$PeopleModel->getAllPeople();

        // Pasar los datos a la vista
        $datos = ['registros' => $registros];
        $this->vista('pages/admin/adminView', $datos);
    }
    public function mostrarDatos()
{
    if (isset($_POST['select_id'])) {
        $id = $_POST['select_id'];
        $registro = $this->PeopleModel->getPersonaById($id);

        // Si el registro no es un array, lo convertimos a uno
        $registros = is_array($registro) ? [$registro] : [$registro];

        // Pasar los datos a la vista
        $datos = ['registros' => $registros];
        require_once RUTA_APP . '/views/pages/admin/adminView.php';
    } else {
        // Si no hay datos, pasamos un array vacío
        $datos = ['registros' => []];
        require_once RUTA_APP . '/views/pages/admin/adminView.php';
    }
}

}