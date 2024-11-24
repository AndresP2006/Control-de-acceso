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


    public function index($message = null)
    {
        return [
            'messageInfo' => $message,
        ];
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
            // Recoger los datos del nuevo usuario
            $datos = [
                'Cedula' => trim($_POST['U_id']),
                'Nombre' => trim($_POST['U_Nombre']),
                'Apellidos' => trim($_POST['U_Apellido']),
                'Telefono' => trim($_POST['U_Telefono']),
                'Gmail' => trim($_POST['U_Gmail']),
                'Departamento' => trim($_POST['U_Departamento']),
                'Rol' => trim($_POST['U_id']),
                'Contrasena' => trim($_POST['U_contrasena']),
            ];
    
            // Mensaje de éxito
            $message = 'Usuario guardado correctamente';
    
            // Agregar el nuevo usuario
            $this->AdminModel->addUser($datos);
    
            // Obtener todos los usuarios después de agregar el nuevo
            $registros = $this->PeopleModel->getAllUsuario(); // Asegúrate de que este método devuelva todos los usuarios
    
            // Formatear los datos de los usuarios como lo mencionas
            $usuarios = [];
            foreach ($registros as $registro) {
                $usuarios[] = [
                    'Cedula' => $registro->Pe_id,
                    'Pe_nombre' => $registro->Pe_nombre,
                    'Pe_apellidos' => $registro->Pe_apellidos,
                    'Pe_telefono' => $registro->Pe_telefono,
                    'Us_correo' => $registro->Us_correo,
                    'Ap_id' => $registro->Ap_id,
                    'Ro_tipo' => $registro->Ro_tipo,
                ];
            }
    
            // Pasar los usuarios y el mensaje a la vista
            $datosVista = [
                'messageInfo' => $message,
                'usuarios' => $usuarios,  // Asegúrate de pasar los usuarios a la vista
            ];
    
            // Cargar la vista con los datos
            $this->vista('pages/admin/AdminView', $datosVista);
            exit;  // Evita que se siga ejecutando el script o redirigiendo a otra página
        } else {
            echo "error";
        }
        
    }
    


    public function UdateUser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['udate'])) {

            $datos = [
                'Cedula' => trim($_POST['E_id']),
                'Nombre' => trim($_POST['E_Nombre']),
                'Apellidos' => trim($_POST['E_Apellido']),
                'Telefono' => trim($_POST['E_Telefono']),
                'Gmail' => trim($_POST['E_Gmail']),
                'Departamento' => trim($_POST['E_Departamento']),
                'Rol' => trim($_POST['R_id']),
                'Contrasena' => trim($_POST['E_contrasena']),
            ];
        }
    }

    public function DeleteUser()
{
    // Verificar si se han enviado los datos necesarios
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletebtn']) && isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];

        // Llamar al modelo para eliminar el registro
        $this->AdminModel->eliminarRegistro($delete_id);

        // Opcionalmente, puedes configurar una variable de sesión o un mensaje flash para mostrar en la misma página
        $_SESSION['message'] = 'Usuario borrado correctamente';
    } else {
        $_SESSION['error'] = 'Error: No se pudo procesar la solicitud';
    }

    // Redirigir a la misma página para evitar redireccionamientos extraños
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}


public function MostrarDatos()
{
    // Captura el filtro desde el formulario POST o retiene el valor previo si existe
    $roleId = isset($_POST['select_id']) && $_POST['select_id'] !== '' ? intval($_POST['select_id']) : null;

    // Obtén todos los registros de usuarios con o sin filtro
    $registros = $this->PeopleModel->getAllUsuario($roleId);

    // Si no hay registros, devuelve un mensaje
    if (empty($registros)) {
        return [
            'usuarios' => [],
            'messageInfo' => 'No se encontraron registros.',
            'filter' => $roleId, // Mantener el filtro actual
        ];
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
            'Us_contrasena' => $registro->Us_contrasena,
            'Ap_id' => $registro->Ap_id,
            'Ro_tipo' => $registro->Ro_tipo,
        ];
    }

    return [
        'usuarios' => $usuarios,
        'messageInfo' => null,
        'filter' => $roleId,
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




//Este metodo de la barra de búsqueda
public function BuscarUsuario()
{
    // Verifica si se ha enviado un término de búsqueda
    if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
        $id = $_POST['id_usuario'];
        
        // Realiza la búsqueda en la base de datos
        $registro = $this->PeopleModel->getPersonaById($id);
        
        if ($registro) { // Si se encuentra el registro
            // Mapea los registros para la vista
            $usuarios = [
                'Cedula' => $registro->Pe_id,
                'Pe_nombre' => $registro->Pe_nombre,
                'Pe_apellidos' => $registro->Pe_apellidos,
                'Pe_telefono' => $registro->Pe_telefono,
                'Us_correo' => $registro->Us_correo,
                'Ap_id' => $registro->Ap_id,
                'Ro_id' => $registro->Ro_id,
                'Ro_tipo' => $registro->Ro_tipo,
            ];
            
            $datos = [
                'usuarios' => [$usuarios], // Usar un array dentro de 'usuarios'
                'filter' => $registro->Ro_id, // Pasar el rol encontrado al filtro
            ];
        } else {
            // Si no se encuentra el usuario, enviar un mensaje de error
            $datos = [
                'error' => "No se encontró el usuario con ID: $id"
            ];
        }
    } else {
        // Si no se ha enviado un término de búsqueda
        $datos = [
            'error' => 'No se ha enviado un término de búsqueda válido.'
        ];
    }

    // Renderiza la vista con los datos obtenidos
    $this->vista('pages/admin/adminView', $datos);
}


}
