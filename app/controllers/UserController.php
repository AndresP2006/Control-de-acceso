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
        
        // Eliminar el registro en el modelo
        $this->AdminModel->eliminarRegistro($delete_id);

        // Obtener el filtro actual (en caso de que se haya seleccionado uno)
        $roleId = isset($_POST['select_id']) ? intval($_POST['select_id']) : null;

        // Redirigir a la lista de registros después de la eliminación y mantener el filtro
        header('location:' . RUTA_URL . '/UserController/admin?select_id=' . $roleId);
        exit;
    } else {
        echo "Error: No se envió el ID del registro";
    }
}


public function MostrarDatos()
{
    // Captura el filtro desde el formulario POST o retiene el valor previo si existe
    $roleId = isset($_POST['select_id']) ? intval($_POST['select_id']) : null;

    // Obtén todos los registros de usuarios con o sin filtro
    $registros = $this->PeopleModel->getAllUsuario($roleId);

    // Si no hay registros, devuelve un mensaje
    if (!$registros) {
        return ['messageInfo' => 'No se encontraron registros.', 'usuarios' => []];
    }

    // Mapeamos los datos en un array asociativo para la vista
    $usuarios = [];
    foreach ($registros as $registro) {
        $usuarios[] = [
            'Cedula' => $registro->Pe_id,
            'Pe_nombre' => $registro->Pe_nombre,
            'Pe_apellidos' => $registro->Pe_apellidos,
            'Pe_telefono' => $registro->Pe_telefono,
            'Us_correo' => $registro->Us_correo,
            'Ap_id' => $registro->Ap_id,
            'Ro_id' => $registro->Ro_id,
        ];
    }

    return [
        'usuarios' => $usuarios,
        'messageInfo' => null,
        'filter' => $roleId, // Mantener el filtro actual
    ];
}


public function admin()
{
    // Verifica la sesión antes de mostrar la vista
    if (!isset($_SESSION['sesion_activa'])) {
        header('location:' . RUTA_URL . '/pages/homeView');
        exit;
    }

    // Obtiene los datos para la vista
    $datos = $this->MostrarDatos();

    // Llama a la vista pasando los datos
    $this->vista('pages/admin/adminView', $datos);
}


// Controlador: AdminController.php

public function BuscarUsuario() {
    // Verifica si se ha enviado un término de búsqueda
    if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
        $id = $_POST['id_usuario'];
    
        // Realiza la búsqueda en la base de datos
        $registro = $this->PeopleModel->getPersonaById($id);
        if ($registro) {
            // Mapea los registros para la vista
            $usuarios = [
                'Cedula' => $registro->Pe_id,
                'Pe_nombre' => $registro->Pe_nombre,
                'Pe_apellidos' => $registro->Pe_apellidos,
                'Pe_telefono' => $registro->Pe_telefono,
                'Us_correo' => $registro->Us_correo,
                'Ap_id' => $registro->Ap_id,
                'Ro_id' => $registro->Ro_id,
            ];
            // Crear el array de datos para pasar a la vista
            $datos = [
                'usuarios' => [$usuarios] // Usar un array dentro de 'usuarios'
            ];
            $this->vista('pages/admin/adminView', $datos);
        } else {
            echo "No se encontró el usuario con la cédula: " . $id;
        }
    } else {
        echo "Por favor ingresa una cédula para buscar.";
    }
    
}

}
