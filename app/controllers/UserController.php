<?php
class UserController extends Controlador
{
    private $AdminModel;
    private $PeopleModel;

    public function __construct()
    {
        // Inicialización de los modelos
        $this->AdminModel = $this->modelo('AdminModel');
        $this->PeopleModel = $this->modelo('PeopleModel');
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

    public function DeleteUser()
{
    // Verificar si el ID ha sido enviado
    if (isset($_POST['deletebtn']) && isset($_POST['delete_id'])) {
        // Obtener el ID del registro a eliminar
        $delete_id = $_POST['delete_id'];
        $message = 'Usuario borrado correctamente';
        echo $delete_id;
        // Eliminar el registro en el modelo
        $this->AdminModel->eliminarRegistro($delete_id);

        
        // Redirigir a la lista de registros después de la eliminación
        $datos = [
            'messageInfo' => $message,
        ];
        $this->vista('pages/admin/AdminView', $datos);
    } 
}

}
